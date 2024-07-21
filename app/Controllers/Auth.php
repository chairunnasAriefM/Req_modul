<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CivitasModel;
use App\Models\StaffPerpustakaanModel;
use Google_Client;

class Auth extends BaseController
{
    protected $googleClient;
    protected $civitas;
    protected $staff;

    public function __construct()
    {
        session();
        $this->civitas = new CivitasModel();
        $this->staff = new StaffPerpustakaanModel();
        $this->googleClient = new Google_Client();

        $this->googleClient->setClientId('294017094906-5ffk2dvbkccuqof05f50403eourinuul.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/login/proses');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');

        JWT::$leeway = 60;
    }

    public function index()
    {
        $data['link'] = $this->googleClient->createAuthUrl();
        return view('auth/index', $data);
    }

    public function proses()
    {
        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            $googleService = new \Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();


            // Verifikasi token
            $payload = $this->googleClient->verifyIdToken($token['id_token']);
            if ($payload) {
                $email = $data['email'];

                // Cek apakah pengguna sudah ada di database
                $existingUser = $this->civitas->where('email', $email)->first();

                // Generate random password untuk pengguna baru
                $randomPassword = bin2hex(random_bytes(16));
                $hashedPassword = password_hash($randomPassword, PASSWORD_DEFAULT);

                if (!$existingUser) {
                    // Pengguna baru
                    $row = [
                        'id_anggota' => $data['id'],
                        'nama' => $data['name'],
                        'email' => $email,
                        'password' => $hashedPassword,
                    ];
                } else {
                    // Pengguna sudah ada, ambil id dan perbarui informasi
                    $row = [
                        'id_anggota' => $existingUser->id_anggota,
                        'nama' => $data['name'],
                        'email' => $email,
                        'password' => $existingUser->password, // Jangan ubah password yang sudah ada
                    ];
                }


                // Simpan atau update user
                $this->civitas->save($row);
                session()->set($row);
                session()->set('logged_in', TRUE);
                session()->regenerate(true);

                return redirect()->to('/');
            } else {
                session()->setFlashdata('msg', 'Token tidak valid');
                return redirect()->to('login');
            }
        } else {
            session()->setFlashdata('msg', 'Gagal mendapatkan token');
            return redirect()->to('login');
        }
    }

    public function registrasi()
    {
        return view('auth/registrasi');
    }

    public function registrasiProses()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[civitas.email]',
            'password' => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');

            $role = $this->determineRole($email);

            if ($role === false) {
                return redirect()->back()->with('msg', 'Email bukan warga PCR')->withInput();
            }

            $data = [
                'id_anggota' => '',
                'nama' => $this->request->getVar('nama'),
                'email' => $email,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT), // Hashing password
                'is_dosen' => 0, // Set default value for is_dosen
            ];

            if ($this->civitas->save($data)) {
                return redirect()->to('/login')->with('msg', 'Registrasi berhasil. Silakan login.');
            } else {
                return redirect()->back()->with('msg', 'Terjadi galat saat menyimpan data. Coba lagi.')->withInput();
            }
        } else {
            $data['validation'] = $this->validator;
            return view('auth/registrasi', $data);
        }
    }

    private function generateUniqueIdAnggota($model, $maxAttempts = 5)
    {
        $attempts = 0;
        do {
            $id_anggota = random_int(1, 99999999999); // Generate random 11-digit integer
            $exists = $model->where('id_anggota', $id_anggota)->first();
            $attempts++;
        } while ($exists && $attempts < $maxAttempts);

        if ($exists) {
            // If after max attempts a unique ID could not be generated, return false
            return false;
        }

        return $id_anggota;
    }




    private function determineRole($email)
    {
        if (strpos($email, '@mahasiswa.pcr.ac.id') !== false) {
            return 'mahasiswa';
        } elseif (strpos($email, '@pcr.ac.id') !== false) {
            return 'civitas';
        } else {
            return false;
        }
    }



    public function loginBiasa()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Debugging: Check if email and password are received
        if (!$email || !$password) {
            $session->setFlashdata('msg', 'Email dan password wajib diisi');
            return redirect()->to('/login');
        }

        // Cek di tabel civitas
        $data = $this->civitas->where('email', $email)->first();

        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_anggota' => $data->id_anggota,
                    'nama'       => $data->nama,
                    'email'      => $data->email,
                    'is_dosen'   => (int)$data->is_dosen,
                    'logged_in'  => TRUE
                ];
                $session->set($ses_data);
                session()->set('logged_in', TRUE);
                session()->regenerate(true);

                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to('/login');
            }
        }

        // Cek di tabel staff_perpustakaan
        $data = $this->staff->where('email', $email)->first();

        if ($data) {
            $pass = $data->password; // Menggunakan sintaks objek
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'staff_id'   => $data->staff_id,   // Menggunakan sintaks objek
                    'nama_staff' => $data->nama_staff, // Menggunakan sintaks objek
                    'email'      => $data->email,      // Menggunakan sintaks objek
                    'role'       => 'staff',
                    'logged_in'  => TRUE
                ];
                $session->set($ses_data);
                session()->set('logged_in', TRUE);
                session()->regenerate(true);

                // Redirect untuk staff
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password atau Email salah');
                return redirect()->to('/login');
            }
        }

        $session->setFlashdata('msg', 'Email tidak ditemukan');
        return redirect()->to('/login');
    }

    public function rehashPasswords()
    {
        $model = new CivitasModel();
        $users = $model->findAll();

        foreach ($users as $user) {
            $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
            $model->update($user['id_anggota'], ['password' => $hashedPassword]);
        }

        echo "Password rehashed successfully.";
    }


    // logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    public function tampilDosen()
    {
        $civitasModel = new CivitasModel();

        $dosen = $civitasModel->where('is_dosen', TRUE)->findAll();

        return view('pages/staff/dosen/tampilDosen.php', ['dosens' => $dosen]);
    }

    public function tambahDosen()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_emailis_unique[civitas.email]',
            'password' => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');
            $role = $this->determineRole($email);

            if ($role === false) {
                return redirect()->back()->with('msg', 'Email bukan warga PCR');
            }

            $civitas = new CivitasModel();
            $uuid = bin2hex(random_bytes(16));
            $data = [
                'id_anggota' => $uuid,
                'nama' => $this->request->getVar('nama'),
                'email' => $email,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'is_dosen' => TRUE
            ];

            $civitas->save($data);
            return redirect()->to('/dashboard/tambahDosen')->with('swal', 'Data berhasil Ditambah');
        } else {
            $data['validation'] = $this->validator;
            echo view('pages/staff/dosen/tambahDosen.php', $data);
        }
    }

    // update dosen
    public function updateDosen()
    {
        $rules = [
            'id_anggota' => 'required', // Ensure this is passed as a hidden input in your form
            'nama' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'permit_empty|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $id_anggota = $this->request->getVar('id_anggota');
            $data = [
                'nama' => $this->request->getVar('nama'),
                'email' => $this->request->getVar('email'),
            ];

            // Update password only if it is provided
            if (!empty($this->request->getVar('password'))) {
                $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            }

            $civitas = new CivitasModel();
            $civitas->update($id_anggota, $data);

            return redirect()->to('/dashboard/tampilDosen')->with('swal', 'Data berhasil Diperbarui');
        } else {
            // Pass the validation errors back to the form
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }


    // hapus dosen 
    public function deleteDosen($id_anggota)
    {
        $civitas = new CivitasModel();
        if ($civitas->delete($id_anggota)) {
            return redirect()->to('/dashboard/tampilDosen')->with('swal', 'Data berhasil Dihapus');
        } else {
            return redirect()->to('/dashboard/tampilDosen')->with('swal', 'Error deleting the data');
        }
    }

    // registrasi staffPerpustakaan
    public function registrasiStaff()
    {
        return view('auth/regisStaff');
    }

    public function registrasiProsesStaff()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[staff_perpustakaan.email]',
            'password' => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');

            $uuid = bin2hex(random_bytes(16));
            $data = [
                'staff_id' => $uuid,
                'nama_staff' => $this->request->getVar('nama'),
                'email' => $email,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $this->staff->save($data);
            return redirect()->to('/');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/registrasi', $data);
        }
    }
}
