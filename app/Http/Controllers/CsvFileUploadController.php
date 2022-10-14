<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CsvFileUploadController extends Controller
{
	public function csvFileUpload(Request $request)
	{
		return view('welcome');
	}

	public function store(Request $request)
	{
		$request->validate([

			'file' => 'required|mimes:csv|max:2048',
		]);

		try {

			$file = $request->file('file');

			$fileName   = $file->getClientOriginalName();

			$path = 'Master/v1/';

			Storage::disk('public')->put($path . $fileName, File::get($file));

			return redirect()->back()
                ->withSuccess('File upload successfully');

		} catch (Exception $e) {

			logger($e->getMessage());

			return redirect()->back()
                ->withError('Something went wrong');
		}
	}

	public function testStore(Request $request)
	{
		try {

			$path = 'Master/v1/';

			Storage::disk('public')->put($path . $request->file_name . '.json', $request->json_data);

			return true;
		} catch (Exception $exception) {

			Log::error($exception);
			return false;
		}
	}
}
