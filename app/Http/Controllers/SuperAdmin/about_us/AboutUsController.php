<?php

namespace App\Http\Controllers\SuperAdmin\about_us;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\about_us\AboutUsRequest;
use App\Http\Traits\Utils\UploadFileTrait;
use App\Models\SuperAdmin\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    use UploadFileTrait;

    protected $filePath = 'images/aboutUs';

    public function edit($id)
    {
        $about = AboutUs::find($id);
        return view('dashboard.aboutUs.edit', compact('about'));
    }

    public function update(AboutUsRequest  $request, string $id)
    {
        // dd($request->all());
        $data = $request->validated();


        $about = AboutUs::findOrFail($id);



        if ($request->has('image')) {
            $data['image'] = $this->updateFile($data['image'], $about->image, $this->filePath);
        }
        if ($request->has('value_image')) {
            $data['value_image'] = $this->updateFile($data['value_image'], $about->value_image, $this->filePath);
        }
        if ($request->has('vision_image')) {
            $data['vision_image'] = $this->updateFile($data['vision_image'], $about->vision_image, $this->filePath);
        }
        if ($request->has('team_image')) {
            $data['team_image'] = $this->updateFile($data['team_image'], $about->team_image, $this->filePath);
        }

        $about->update($data);

        return redirect()->back()->with('success', 'About Us updated successfully');
    }
}
