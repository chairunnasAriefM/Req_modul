<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use Google_Client;

class Login extends BaseController
{
    protected $googleClient;
    protected $users;
    protected $mahasiswa;
    protected $dosen;

    public function __construct()
    {
        session();
        $this->users = new UsersModel();
        $this->mahasiswa = new MahasiswaModel();
        $this->dosen = new DosenModel();
        $this->googleClient = new Google_Client();

        $this->googleClient->setClientId('237280244422-8rj1bmnqubmp2oj4d3p6bcoqbrtf61dh.apps.googleusercontent.com');
        $this->googleClient->setClientSecret('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');
        $this->googleClient->setRedirectUri('http://localhost:8080/login/proses');
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }

    public function index()
    {
        $data['link'] = $this->googleClient->createAuthUrl();
        return view('login/index', $data);
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
                if (strpos($email, '@mahasiswa.pcr.ac.id') !== false) {
                    $row = [
                        'id_anggota' => $data['id'],
                        'nama' => $data['name'],
                        'email' => $email,
                        // 'profile' => $data['picture'],
                    ];

                    $this->mahasiswa->save($row);
                    session()->set($row);
                    session()->set('role', 'mahasiswa');
                    session()->regenerate(true);
                    return view('login/berhasil');
                } elseif (strpos($email, '@dosen.pcr.ac.id') !== false) {
                    $row = [
                        'id_dosen' => $data['id'],
                        'nama' => $data['name'],
                        'email' => $email,
                        // 'profile' => $data['picture'],
                    ];

                    $this->dosen->save($row);
                    session()->set($row);
                    session()->set('role', 'dosen');
                    session()->regenerate(true);
                    return view('login/berhasil_dosen');
                } else {
                    session()->setFlashdata('error', 'Hanya email @mahasiswa.pcr.ac.id atau @dosen.pcr.ac.id yang diperbolehkan');
                    return redirect()->to('login');
                }
            } else {
                session()->setFlashdata('error', 'Token tidak valid');
                return redirect()->to('login');
            }
        } else {
            session()->setFlashdata('error', 'Gagal mendapatkan token');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
