<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku;

class BukuController extends Controller
{
    //
    public function tambah(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'judul_buku' => 'required|string|max:200|min:3',
                'deskripsi_buku' => 'required|string|min:5',
                'tahun_terbit' => 'required|min:4|max:4',
                'stok_buku' => 'required|numeric',
                'gambar_buku' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);
            $nama_gambar = time() . '_' . $request->file('gambar_buku')->getClientOriginalName();
            $upload = $request->gambar_buku->storeAs('public/sampul_buku', $nama_gambar);
            $path = Storage::url($upload);
            Buku::create([
                'judul_buku' => $request->judul_buku,
                'deskripsi_buku' => $request->deskripsi_buku,
                'tahun_terbit' => $request->tahun_terbit,
                'stok_buku' => $request->stok_buku,
                'gambar_buku' => $path
            ]);
            return redirect('/tambah')->with('status', 'Data telah tersimpan di database');
 
        }
        return view('tambah');
    }

    public function index()
    {
        $buku = Buku::query()->select()->get();
        return view('crudapp.index',compact('buku'));
    }
 
    // public function dataTable(Request $request)
    // {
    //     $totalFilteredRecord = $totalDataRecord = $draw_val = "";
    //     $columns_list = array(
    //         0 =>'judul_buku',
    //         1 =>'tahun_terbit',
    //         2=> 'stok_buku',
    //         3=> 'gambar_buku',
    //         4=> 'id',
    //     );
 
    //     $totalDataRecord = Buku::count();
 
    //     $totalFilteredRecord = $totalDataRecord;
 
    //     $limit_val = $request->input('length');
    //     $start_val = $request->input('start');
    //     $order_val = $columns_list[$request->input('order.0.column')];
    //     $dir_val = $request->input('order.0.dir');
 
    //     if(empty($request->input('search.value')))
    //     {
    //         $buku_data = Buku::offset($start_val)
    //         ->limit($limit_val)
    //         ->orderBy($order_val,$dir_val)
    //         ->get();
    //     } else {
    //         $search_text = $request->input('search.value');
 
    //         $buku_data =  Buku::where('id','LIKE',"%{$search_text}%")
    //         ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
    //         ->offset($start_val)
    //         ->limit($limit_val)
    //         ->orderBy($order_val,$dir_val)
    //         ->get();
 
    //         $totalFilteredRecord = Buku::where('id','LIKE',"%{$search_text}%")
    //         ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
    //         ->count();
    //     }
 
    //     $data_val = array();
    //     if(!empty($buku_data))
    //     {
    //         foreach ($buku_data as $buku_val)
    //         {
    //             $bukunestedData['judul_buku'] = $buku_val->judul_buku;
    //             $bukunestedData['tahun_terbit'] = $buku_val->tahun_terbit;
    //             $bukunestedData['stok_buku'] = $buku_val->stok_buku;
    //             $bukunestedData['gambar_buku'] = "<img src='$buku_val->gambar_buku' class='img-thumbnail' width='200px'>";
    //             $bukunestedData['options'] = "<a href='#'><i class='fas fa-edit fa-lg'></i></a> <button style='border: none; background-color:transparent;' class='deleteRecord' data-id='$buku_val->id'><i class='fas fa-trash fa-lg text-danger'></i></button>";
    //             $data_val[] = $bukunestedData;
    //         }
    //     }
    //     $draw_val = $request->input('draw');
    //     $get_json_data = array(
    //     "draw"            => intval($draw_val),
    //     "recordsTotal"    => intval($totalDataRecord),
    //     "recordsFiltered" => intval($totalFilteredRecord),
    //     "data"            => $data_val
    //     );
 
    //     echo json_encode($get_json_data);
    // }

    // public function dataTable(Request $request)
    // {
    //     $totalFilteredRecord = $totalDataRecord = $draw_val = "";
    //     $columns_list = array(
    //         0 =>'judul_buku',
    //         1 =>'tahun_terbit',
    //         2=> 'stok_buku',
    //         3=> 'gambar_buku',
    //         4=> 'id',
    //     );
 
    //     $totalDataRecord = Buku::count();
 
    //     $totalFilteredRecord = $totalDataRecord;
 
    //     $limit_val = $request->input('length');
    //     $start_val = $request->input('start');
    //     $order_val = $columns_list[$request->input('order.0.column')];
    //     $dir_val = $request->input('order.0.dir');
 
    //     if(empty($request->input('search.value')))
    //     {
    //         $buku_data = Buku::offset($start_val)
    //         ->limit($limit_val)
    //         ->orderBy($order_val,$dir_val)
    //         ->get();
    //     } else {
    //         $search_text = $request->input('search.value');
 
    //         $buku_data =  Buku::where('id','LIKE',"%{$search_text}%")
    //         ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
    //         ->offset($start_val)
    //         ->limit($limit_val)
    //         ->orderBy($order_val,$dir_val)
    //         ->get();
 
    //         $totalFilteredRecord = Buku::where('id','LIKE',"%{$search_text}%")
    //         ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
    //         ->count();
    //     }
 
    //     $data_val = array();
    //     if(!empty($buku_data))
    //     {
    //         foreach ($buku_data as $buku_val)
    //         {
    //             $url = route('ubahData',['id' => $buku_val->id]); //kode baru
    //             $bukunestedData['judul_buku'] = $buku_val->judul_buku;
    //             $bukunestedData['tahun_terbit'] = $buku_val->tahun_terbit;
    //             $bukunestedData['stok_buku'] = $buku_val->stok_buku;
    //             $bukunestedData['gambar_buku'] = "<img src='$buku_val->gambar_buku' class='img-thumbnail' width='200px'>";
    //             $bukunestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <button style='border: none; background-color:transparent;' class='deleteRecord' data-id='$buku_val->id'><i class='fas fa-trash fa-lg text-danger'></i></button>"; // kode baru
    //             $data_val[] = $bukunestedData;
    //         }
    //     }
    //     $draw_val = $request->input('draw');
    //     $get_json_data = array(
    //     "draw"            => intval($draw_val),
    //     "recordsTotal"    => intval($totalDataRecord),
    //     "recordsFiltered" => intval($totalFilteredRecord),
    //     "data"            => $data_val
    //     );
 
    //     echo json_encode($get_json_data);
    // }

    public function dataTable(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 =>'judul_buku',
            1 =>'tahun_terbit',
            2=> 'stok_buku',
            3=> 'gambar_buku',
            4=> 'id',
        );
 
        $totalDataRecord = Buku::count();
 
        $totalFilteredRecord = $totalDataRecord;
 
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
 
        if(empty($request->input('search.value')))
        {
            $buku_data = Buku::offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();
        } else {
            $search_text = $request->input('search.value');
 
            $buku_data =  Buku::where('id','LIKE',"%{$search_text}%")
            ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
            ->offset($start_val)
            ->limit($limit_val)
            ->orderBy($order_val,$dir_val)
            ->get();
 
            $totalFilteredRecord = Buku::where('id','LIKE',"%{$search_text}%")
            ->orWhere('judul_buku', 'LIKE',"%{$search_text}%")
            ->count();
        }
 
        $data_val = array();
        if(!empty($buku_data))
        {
            foreach ($buku_data as $buku_val)
            {
                $url = route('ubahData',['id' => $buku_val->id]);
                $urlHapus = route('hapusData',$buku_val->id); // kode baru
                $bukunestedData['judul_buku'] = $buku_val->judul_buku;
                $bukunestedData['tahun_terbit'] = $buku_val->tahun_terbit;
                $bukunestedData['stok_buku'] = $buku_val->stok_buku;
                $bukunestedData['gambar_buku'] = "<img src='$buku_val->gambar_buku' class='img-thumbnail' width='200px'>";
                $bukunestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$buku_val->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>"; // kode baru
                $data_val[] = $bukunestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );
 
        echo json_encode($get_json_data);
    }

    public function ubahData($id,Request $request)
    {
        $buku = Buku::findOrFail($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'judul_buku' => 'required|string|max:200|min:3',
                'deskripsi_buku' => 'required|string|min:5',
                'tahun_terbit' => 'required|min:4|max:4',
                'stok_buku' => 'required|numeric',
                'gambar_buku' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024'
            ]);
            $img_old = $buku->gambar_buku;
            if ($request->file('gambar_buku') != null) {
                # hapus img lama
                if ($img_old && file_exists(public_path().$img_old)) {
                    unlink(public_path().$img_old);
                    # sukses hapus
                }
                $nama_gambar = time() . '_' . $request->file('gambar_buku')->getClientOriginalName();
                $upload = $request->gambar_buku->storeAs('public/sampul_buku', $nama_gambar);
                $img_old = Storage::url($upload);
            }
            $buku->update([
                'judul_buku' => $request->judul_buku,
                'deskripsi_buku' => $request->deskripsi_buku,
                'tahun_terbit' => $request->tahun_terbit,
                'stok_buku' => $request->stok_buku,
                'gambar_buku' => $img_old
            ]);
            return redirect()->route('ubahData',['id' => $buku->id])->with('status', 'Data telah tersimpan di database');
        }
        return view('crudapp.ubah', [
            'buku' => $buku
        ]);
    }

    public function hapusData($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->gambar_buku && file_exists(public_path().$buku->gambar_buku)) {
            // hapus gambar
            unlink(public_path().$buku->gambar_buku);
        }
        // hapus data
        $buku->delete($id);
        return redirect()->back();
    }

}
