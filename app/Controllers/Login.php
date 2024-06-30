<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CivitasAkademikModel;
use App\Models\StaffPerpustakaanModel;
use Google_Client;

class Login extends BaseController
{
    protected $googleClient;
    protected $civitas;
    protected $staff;

    public function __construct()
    {
        session();
        $this->civitas = new CivitasAkademikModel();
        $this->staff = new StaffPerpustakaanModel();
        $this->googleClient = new Google_Client();

        $this->googleClient->setClientId('294017094906-5ffk2dvbkccuqof05f50403eourinuul.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/login/proses');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
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
                        'role' => ''
                    ];
                } else {
                    // Pengguna sudah ada, ambil id dan perbarui informasi
                    $row = [
                        'id_anggota' => $existingUser->id_anggota,
                        'nama' => $data['name'],
                        'email' => $email,
                        'password' => $existingUser->password, // Jangan ubah password yang sudah ada
                        'role' => $existingUser->role
                    ];
                }

                // cek warga pcr atau tidak
                if (strpos($email, '@mahasiswa.pcr.ac.id') !== false) {
                    $row['role'] = 'mahasiswa';
                } elseif (strpos($email, '@dosen.pcr.ac.id') !== false) {
                    $row['role'] = 'dosen';
                } else {
                    $row['role'] = 'civitas';
                }

                // Simpan atau update user
                $this->civitas->save($row);
                session()->set($row);
                session()->set('logged_in', TRUE);
                session()->regenerate(true);

                // Tampilkan data dalam format JSON
                // header('Content-Type: application/json');
                // echo json_encode($data);

                // if ($row['role'] == 'mahasiswa') {
                return redirect()->to('/');
                // } else {
                //     return view('pages/regular/request_buku');
                // }
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
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[6]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $email = $this->request->getVar('email');

            // validasi hunter key
            $apiKey = '48f8f955515339e1f68fffa2bea9aec43254b16e';

            $response = file_get_contents("https://api.hunter.io/v2/email-verifier?email={$email}&api_key={$apiKey}");
            $result = json_decode($response, true);

            if ($result['data']['status'] != 'valid') {
                return redirect()->back()->with('msg', 'Email tidak valid.');
            }

            $role = $this->determineRole($email);

            if ($role === false) {
                return redirect()->back()->with('msg', 'Email bukan warga PCR');
            }

            $civitas = new CivitasAkademikModel();
            $uuid = bin2hex(random_bytes(16));
            $data = [
                'id_anggota' => $uuid,
                'nama' => $this->request->getVar('nama'),
                'email' => $email,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $role
            ];

            $civitas->save($data);
            return redirect()->to('/');
        } else {
            $data['validation'] = $this->validator;
            echo view('auth/registrasi', $data);
        }
    }

    private function determineRole($email)
    {
        if (strpos($email, '@mahasiswa.pcr.ac.id') !== false) {
            return 'mahasiswa';
        } elseif (strpos($email, '@dosen.pcr.ac.id') !== false) {
            return 'dosen';
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

        // Cek di tabel civitas_akademik
        $data = $this->civitas->where('email', $email)->first();

        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'id_anggota'   => $data->id_anggota,
                    'nama'     => $data->nama,
                    'email'    => $data->email,
                    'role'     => $data->role,
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                // Redirect berdasarkan role
                // if ($data->role == 'mahasiswa') {
                //     return redirect()->to('buku_request');
                // } elseif ($data->role == 'dosen') {
                return redirect()->to('/');
                // }
            } else {
                $session->setFlashdata('msg', 'Password salah');
                return redirect()->to('/login');
            }
        }

        // Cek di tabel staff_perpustakaan
        $data = $this->staff->where('email', $email)->first();

        if ($data) {
            $pass = $data->password;
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'staff_id'       => $data->staff_id,
                    'nama_staff'     => $data->nama_staff,
                    'email'    => $data->email,
                    'role'     => 'staff',
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);

                // Redirect untuk staff
                return view('pages/regular/request_buku');
            } else {
                $session->setFlashdata('msg', 'Password atau Email salah');
                return redirect()->to('/login');
            }
        }

        $session->setFlashdata('msg', 'Password atau Email salah');
        return redirect()->to('/login');
    }


    // logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
