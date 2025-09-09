<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class Clients extends Controller
{
    //
    public function clients()
    {
        $client_data = Client::paginate(5);
        return view("pages/clients/clients", ["data" => $client_data]);
    }

    public function add_client()
    {
        return view("pages/clients/add_client");
    }

    public function search_cliet(Request $request)
    {
        $search = Client::where("name", "like", "%$request->search%")->paginate(5);
        return view("pages/clients/clients", ["data" => $search]);
    }

    public function add_data(Request $request)
    {
        // validate data
        $validated = $request->validate([
            'name' => 'required | string',
            'email' => 'required | email | string',
            'phone' => 'required | string',
            'company' => 'required',

        ]);

        $user_data = new Client();
        $path = $request->file("image")->store("clients", "public");
        $path_split = explode("/", $path);
        $get_path = $path_split[1];
        $user_data->name = $validated['name'];
        $user_data->email = $validated['email'];
        $user_data->phone = $validated['phone'];
        $user_data->company = $validated['company'];
        $user_data->image = $get_path;

        $user_data->save();
        return redirect()->route("clients");
    }


    public function edit_client($id)
    {
        $get_data = Client::where('id', $id)->first();
        return view("pages/clients/edit_client", ["data" => $get_data]);
    }
    public function edit_data(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required | string',
            'email' => 'required | email | string',
            'phone' => 'required | string',
            'company' => 'required',

        ]);

        $data = Client::findOrFail($id);
        // $path = $request->file("image")->store("clients", "public");
        // $path_split = explode("/", $path);
        // $get_path = $path_split[1];
        $data->name = $validated['name'];
        // $data->email = $validated['email'];
        $data->phone = $validated['phone'];
        $data->company = $validated['company'];
        // $data->image = $get_path;

        $data->save();
        return redirect()->route("clients");
    }



    public function delete_client($id)
    {
        $del_data = Client::findOrFail($id);
        if ($del_data->image) {
            $img = public_path("storage/clients/" . $del_data->image);
            if (file_exists($img)) {
                unlink($img);
            }
        }
        $del_data->delete();
        return redirect()->route("clients");
    }
}
