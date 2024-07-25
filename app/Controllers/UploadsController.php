<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class UploadsController extends Controller
{
    public function index($filename)
    {
        $filePath = WRITEPATH . 'uploads/modul/' . $filename;

        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($filename);
        }

        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->file($filePath);

        // Read the file content
        $fileContent = file_get_contents($filePath);

        // Return the response with the correct headers
        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setContentType($mimeType)
            ->setBody($fileContent)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($filePath) . '"');
    }
}
