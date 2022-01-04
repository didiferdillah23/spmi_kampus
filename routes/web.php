<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UpmController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AmiController;
use App\Http\Controllers\PublicController;

//AUTENTIKASI
Route::get('/login', [AuthController::class, 'show_login']);
Route::post('/login', [AuthController::class, 'login']);
//END AUTENTIKASI

Route::get('/', [PublicController::class, 'index']);
Route::get('/download-file-mutu/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_mutu/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');
        // end dokumen mutu

//ADMIN
Route::prefix('admin')->group(function() {
    Route::middleware(['cekLogin', 'isAdmin'])->group(function () {
        // user
        Route::get('/',[AdminController::class, 'index']);
        Route::get('/data-user/{level}',[AdminController::class, 'show_user']);
        Route::get('/data-user/cari/{level}',[AdminController::class, 'search_user']);
        Route::post('/add-user',[AdminController::class, 'tambah_user']);
        Route::get('/hapus-user/{id}',[AdminController::class, 'destroy_user']);
        Route::get('/edit-user/{id}/{level}',[AdminController::class, 'show_edit_user']);
        Route::post('/edit-user',[AdminController::class, 'edit_user']);
        // end user
        
        // dokumen mutu
        Route::get('/lihat/{jenis_dok}',[AdminController::class, 'show_dokumen']);
        Route::get('/lihatt/{jenis_dok}',[AdminController::class, 'show_dokumen_sf']);
        Route::get('/lihatt/{jenis_dok}/cari',[AdminController::class, 'search_dokumen_sf']);
        // Download Route
        Route::get('/download_dok_mutu/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_mutu/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');
        // end dokumen mutu
    });
});
//END ADMIN

//UPM
Route::prefix('upm')->group(function() {
    Route::middleware(['cekLogin', 'isUpm'])->group(function () {
        Route::get('/',[UpmController::class, 'index']);
        Route::get('/cari-dokumen',[UpmController::class, 'search_dokumen']);
        Route::post('/add-dokumen',[UpmController::class, 'add_dokumen']);
        Route::get('/edit-dok/{id}',[UpmController::class, 'show_edit_dok_mutu']);
        Route::post('/edit-dok',[UpmController::class, 'edit_dok_mutu']);
        Route::get('/hapus-dokumen/{id}/{filename}',[UpmController::class, 'destroy_dokumen']);
    // Download Route
    Route::get('/download_dok_mutu/{filename}', function($filename)
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() .'/app/dok_mutu/'. $filename;
        if (file_exists($file_path))
        {
            // Send Download
            return Response::download($file_path, $filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('File yang anda minta tidak tersedia di server!');
        }
        return redirect()->back();
    })
    ->where('filename', '[A-Za-z0-9\-\_\.]+');
    
    });
});
//END UPM


//UNIT
Route::prefix('unit')->group(function() {
    Route::middleware(['cekLogin', 'isUnit'])->group(function () {
        Route::get('/',[UnitController::class, 'index']);
        Route::get('/cari-dokumen',[UnitController::class, 'search_dokumen']);
        Route::get('/submit-hasil/{id}',[UnitController::class, 'show_hasil_kerja']);
        Route::post('/add-hasil-kerja',[UnitController::class, 'add_hasil_kerja']);
        Route::get('/edit-hasil/{id}',[UnitController::class, 'show_edit_hasil']);
        Route::post('/edit-hasil',[UnitController::class, 'edit_hasil_kerja']);
        Route::get('/hapus-hasil-kerja/{id}/{filename}',[UnitController::class, 'destroy_hasil_kerja']);
        // Download Route
        Route::get('/download_hasil_mutu/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_hasil/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');
        
        Route::get('/download_dok_mutu/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_mutu/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');
    });
});
//END UNIT



//AMI
Route::prefix('ami')->group(function() {
    Route::middleware(['cekLogin', 'isAmi'])->group(function () {
        Route::get('/',[AmiController::class, 'index']);
        Route::get('/cari-unit',[AmiController::class, 'search_unit']);
        // Route::get('/cari-dokumen',[AmiController::class, 'search_dokumen']);
        Route::get('/lihat-hasil/{username}',[AmiController::class, 'show_hasil_kerja']);
        Route::get('/beri-nilai/{hasil_id}/{username}',[AmiController::class, 'show_beri_nilai']);
        Route::post('/beri-nilai',[AmiController::class, 'beri_nilai']);
        Route::get('/edit-nilai/{hasil_id}',[AmiController::class, 'show_edit_nilai']);
        Route::post('/edit-nilai',[AmiController::class, 'edit_nilai']);
        // Download Route
        Route::get('/download_hasil_kerja/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_hasil/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');


        // Download Route
        Route::get('/download_dok_mutu/{filename}', function($filename)
        {
            // Check if file exists in app/storage/file folder
            $file_path = storage_path() .'/app/dok_mutu/'. $filename;
            if (file_exists($file_path))
            {
                // Send Download
                return Response::download($file_path, $filename, [
                    'Content-Length: '. filesize($file_path)
                ]);
            }
            else
            {
                // Error
                exit('File yang anda minta tidak tersedia di server!');
            }
            return redirect()->back();
        })
        ->where('filename', '[A-Za-z0-9\-\_\.]+');
    
    });
});
//END AMI


Route::get('/logout', function() {
    Session::forget('info_login');
    return redirect('/admin');
});