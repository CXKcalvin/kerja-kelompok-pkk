<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ControllerAdmin extends Controller
{
    public function admin()
    {
        $users = User::where('role', 'client')
            ->with('status')
            ->get();

        $statuses = \App\Models\Status::all();
        $services = Service::latest()->get();
        $portfolios = Portfolio::latest()->get();

        return view('admin', compact('users', 'statuses', 'services', 'portfolios'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        $client = User::findOrFail($id);
        $client->status_id = $request->status_id;
        $client->save();

        return back();
    }

    protected function validateModuleRequest(Request $request, bool $isUpdate = false): array
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 20) {
                        $fail('Judul maksimal 20 kata.');
                    }
                },
            ],
            'description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 150) {
                        $fail('Deskripsi maksimal 150 kata.');
                    }
                },
            ],
        ];

        $rules['image'] = $isUpdate
            ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096']
            : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];

        return $request->validate($rules, [
            'image.required' => 'Foto layanan harus diunggah dan berformat gambar.',
            'image.image' => 'File harus berupa foto/gambar.',
            'image.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul tidak boleh melebihi 255 karakter.',
            'description.required' => 'Deskripsi wajib diisi.',
        ]);
    }

    protected function saveUploadedImage($file, string $type): string
    {
        $directory = public_path("img/uploads/{$type}");

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = uniqid("{$type}_") . '.' . $file->getClientOriginalExtension();
        $file->move($directory, $filename);

        return "img/uploads/{$type}/{$filename}";
    }

    public function storeService(Request $request)
    {
        $data = $this->validateModuleRequest($request, false);
        $data['image_path'] = $this->saveUploadedImage($request->file('image'), 'services');

        Service::create($data);

        return back()->with('success', 'Layanan baru berhasil ditambahkan.');
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $data = $this->validateModuleRequest($request, true);

        if ($request->hasFile('image')) {
            if ($service->image_path && File::exists(public_path($service->image_path))) {
                File::delete(public_path($service->image_path));
            }
            $data['image_path'] = $this->saveUploadedImage($request->file('image'), 'services');
        }

        $service->update($data);

        return back()->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroyService($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image_path && File::exists(public_path($service->image_path))) {
            File::delete(public_path($service->image_path));
        }

        $service->delete();

        return back()->with('success', 'Layanan berhasil dihapus.');
    }

    public function storePortfolio(Request $request)
    {
        $data = $this->validateModuleRequest($request, false);
        $data['image_path'] = $this->saveUploadedImage($request->file('image'), 'portfolios');

        Portfolio::create($data);

        return back()->with('success', 'Hasil jasa baru berhasil ditambahkan.');
    }

    public function updatePortfolio(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $data = $this->validateModuleRequest($request, true);

        if ($request->hasFile('image')) {
            if ($portfolio->image_path && File::exists(public_path($portfolio->image_path))) {
                File::delete(public_path($portfolio->image_path));
            }
            $data['image_path'] = $this->saveUploadedImage($request->file('image'), 'portfolios');
        }

        $portfolio->update($data);

        return back()->with('success', 'Hasil jasa berhasil diperbarui.');
    }

    public function destroyPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->image_path && File::exists(public_path($portfolio->image_path))) {
            File::delete(public_path($portfolio->image_path));
        }

        $portfolio->delete();

        return back()->with('success', 'Hasil jasa berhasil dihapus.');
    }
}
