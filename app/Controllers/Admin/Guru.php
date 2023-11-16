<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\GuruModel;
use App\Models\PeriodeModel;
use App\Models\GuruMapelModel;
use App\Models\SekolahModel;
use App\Models\KelasModel;
use App\Models\MapelModel;

class Guru extends BaseController
{
    protected $helpers = ['login'];
    function __construct()
    {
        $this->guruM = new GuruModel;
        $this->guruMapelM = new GuruMapelModel;
    }
    public function index()
    {
        $periodeM = new PeriodeModel;
        $sekolahM = new SekolahModel;
        $data = [
            'title'=> 'Guru',
            'periode'=> $periodeM->findAll(),
            'sekolah'=> $sekolahM->findAll(),
            'guru_mapel'=> $this->guruMapelM->AllGuruMapel()
        ];
        return view('Admin/Guru/index', $data);
    }

    public function ListAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $data = [

                'guru'=> $this->guruM->orderBy('nama', 'asc')->findAll()];
            $view =['list_guru'=> view('Admin/Guru/Akun/Table', $data)];
            echo json_encode($view);
         }
    }
 

    public function NewAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $view =['form_guru'=> view('Admin/Guru/Akun/New')];
            echo json_encode($view);
        }
    }
    public function SaveAkunGuru()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
                $validate = $this->validate(
                [
                'nuptk' => [
                'label'  => 'NUPTK',
                'rules'  => 'required|is_unique[guru.nuptk]',
                'errors' => [
                'required' => '{field} Wajib di isi',
                'is_unique' => '{field} Telah Terdaftar'
                ]
                ],
                'nama' => [
                'label'  => 'Nama & Gelar',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'jk' => [
                'label'  => 'Gender',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'tmp_lahir' => [
                'label'  => 'Tempat Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'tgl_lahir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'pddk_akhir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                ]
                );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
            'error' => [
                'nuptk' => $this->validate->getError('nuptk'),
                'nama' => $this->validate->getError('nama'),
                'jk' => $this->validate->getError('jk'),
                'tmp_lahir' => $this->validate->getError('tmp_lahir'),
                'tgl_lahir' => $this->validate->getError('tgl_lahir'),
                'pddk_akhir' => $this->validate->getError('pddk_akhir')
            ]
            ];
            }else{
            $data = [
            'nuptk'=> $this->request->getPost('nuptk'),
            'nama'=> $this->request->getPost('nama'),
            'jk'=> $this->request->getPost('jk'),
            'tmp_lahir'=> $this->request->getPost('tmp_lahir'),
            'tgl_lahir'=> $this->request->getPost('tgl_lahir'),
            'pddk_akhir'=> $this->request->getPost('pddk_akhir')
            ];
            $this->guruM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil disimpan'
            ];
        }
           echo json_encode($response);
        }
    }

    public function EditAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['guru'=> $this->guruM->find($id)];
            $view =['form_guru'=> view('Admin/Guru/Akun/Edit', $data)];
            echo json_encode($view);
        }
    }

    public function UpdateAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $old_nuptk = $this->request->getPost('old_nuptk');
            $nuptk = $this->request->getPost('nuptk');
            
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
                $validate = $this->validate(
                [
                'nuptk' => [
                'label'  => 'NUPTK',
                'rules'  => $old_nuptk==$nuptk ? 'required': 'required|is_unique[guru.nuptk]',
                'errors' => [
                'required' => '{field} Wajib di isi',
                'is_unique' => '{field} Telah Terdaftar'
                ]
                ],
                'nama' => [
                'label'  => 'Nama & Gelar',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'jk' => [
                'label'  => 'Gender',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'tmp_lahir' => [
                'label'  => 'Tempat Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'tgl_lahir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'pddk_akhir' => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                ]
                );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
            'error' => [
                'nuptk' => $this->validate->getError('nuptk'),
                'nama' => $this->validate->getError('nama'),
                'jk' => $this->validate->getError('jk'),
                'tmp_lahir' => $this->validate->getError('tmp_lahir'),
                'tgl_lahir' => $this->validate->getError('tgl_lahir'),
                'pddk_akhir' => $this->validate->getError('pddk_akhir')
            ]
            ];
            }else{
            $data = [
            'id'=> $this->request->getPost('id'),
            'nuptk'=> $nuptk,
            'nama'=> $this->request->getPost('nama'),
            'jk'=> $this->request->getPost('jk'),
            'tmp_lahir'=> $this->request->getPost('tmp_lahir'),
            'tgl_lahir'=> $this->request->getPost('tgl_lahir'),
            'pddk_akhir'=> $this->request->getPost('pddk_akhir')
            ];
            $this->guruM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Data Berhasil diperbarui'
            ];
        }
           echo json_encode($response);
        }
    }
    public function StatusAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $guru = $this->guruM->find($id);
            $status = $guru['is_active'];
            $data = [
                'id'=> $id,
                'is_active'=> $status==1 ? 0 : 1
            ];

            $this->guruM->save($data);
            $response = [
                'status'=> 201,
                'msg' => 'Status diperbarui'
            ];
            echo json_encode($response);
        }
    }
    public function DeleteAkunGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->guruM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }

    // Guru Mapel 
    public function ListGuruMapel()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'guru_mapel'=> $this->guruMapelM->AllGuruMapel()
            ];
            $view =['list_guru_mapel'=> view('Admin/Guru/Mapel/Table', $data)];
            echo json_encode($view);
         }
    }
// Guru Mapel by Sekolah 
    public function GetGuruBySekolah()
    {
        if ($this->request->isAJAX()) {
            $periode_id = $this->request->getVar('periode_id');
            $sekolah_id = $this->request->getVar('sekolah_id');
            $data = [
                'guru_mapel'=> $this->guruMapelM->BySekolahID($sekolah_id, $periode_id)
            ];
            $view =['list_guru_mapel'=> view('Admin/Guru/Mapel/Table', $data)];
            echo json_encode($view);
         }
    }


    public function NewGuruMapel()
    {
        if ($this->request->isAJAX()) {
            $periodeM = new PeriodeModel;
            $sekolahM = new SekolahModel;
            $mapelM = new MapelModel;
            $periode_id = $this->request->getVar('periode_id');
            $sekolah_id = $this->request->getVar('sekolah_id');
            $data = [
            'periode'=> $periodeM->find($periode_id),
            'sekolah'=> $sekolahM->find($sekolah_id),
            'guru'=> $this->guruM->orderBy('nama', 'asc')->findAll(),
            'mapel'=> $mapelM->findAll()
            ];
            $view =['form_guru_mapel'=> view('Admin/Guru/Mapel/New', $data)];
            echo json_encode($view);
         }
    }
    
    public function GetKelasBySekolah()
    {
        if ($this->request->isAJAX()) {
            $kelasM = new KelasModel;
            $sekolah_id = $this->request->getVar('id');
            $option = "";
            foreach ($kelasM->KelasBySekolah($sekolah_id) as $row) {
                $option .= '<option value="'.$row['id'].'">'.$row['kelas'].'</option>';
            }

            $msg = ['list_kelas'=>  $option];
            echo json_encode($msg);

        }
    }



    public function SaveGuruMapel()
    {
        if ($this->request->isAJAX()) {
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
                $validate = $this->validate(
                [
                'kode_guru' => [
                'label'  => 'Kode Guru Bidang Studi',
                'rules'  => 'required|is_unique[guru_mapel.kode_guru]',
                'errors' => [
                'required' => '{field} Wajib di isi',
                'is_unique' => '{field} Telah digunakan.',
                ]
                ],
                'guru' => [
                'label'  => 'Guru',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'mapel' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'kelas' => [
                'label'  => 'Kelas',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ]
                
                ]
                );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
            'error' => [
                'kode_guru' => $this->validate->getError('kode_guru'),
                'guru' => $this->validate->getError('guru'),
                'mapel' => $this->validate->getError('mapel'),
                'kelas' => $this->validate->getError('kelas')
            ]
            ];
            }else{

                // Ambil data dari form atau input
                $sekolahId = $this->request->getPost('sekolah_id');
                $periodeId = $this->request->getPost('periode_id');
                $guruId = $this->request->getPost('guru');
                $mapelId = $this->request->getPost('mapel');
                $kelasId = $this->request->getPost('kelas');


                // Periksa keunikan kombinasi kolom
        if (!$this->guruMapelM->isCombinationUnique($sekolahId, $periodeId, $guruId, $mapelId, $kelasId)) {
            // Tampilkan pesan error bahwa kombinasi kolom tidak unik
            // echo "Kombinasi kolom tidak unik!";
            $response = [
                'error' => [
                    'guru' => 'Terdapat Data ganda',
                    'mapel' => 'Terdapat Data ganda',
                    'kelas' => 'Terdapat Data ganda',
                ]
                ];
        } else {
            // Lakukan simpan atau update sesuai kebutuhan
            $data = [
                'sekolah_id'=> $sekolahId,
                'periode_id'=> $periodeId,
                'kode_guru'=> $this->request->getPost('kode_guru'),
                'guru_id'=> $guruId,
                'mapel_id'=> $mapelId,
                'kelas_id'=> $kelasId
                ];
                $this->guruMapelM->save($data);
                $response = [
                    'status'=> 201,
                    'msg' => 'Data Guru Bidang Studi Berhasil disimpan'
                ];

        }

           
        }
           echo json_encode($response);
        }
    }

    public function EditGuruMapel()
    {
        if ($this->request->isAJAX()) {
            $periodeM = new PeriodeModel;
            $sekolahM = new SekolahModel;
            $mapelM = new MapelModel;
            $kelasM = new KelasModel;

            $id = $this->request->getVar('id');
            $guru_mapel = $this->guruMapelM->find($id);
            
            $data = [
                'data'=> $guru_mapel,
                'guru'=> $this->guruM->findAll(),
                'periode'=> $periodeM->find($guru_mapel['periode_id']),
                'sekolah'=> $sekolahM->find($guru_mapel['sekolah_id']),
                'kelas'=> $kelasM->where('sekolah_id', $guru_mapel['sekolah_id'])->findAll(),
                'mapel'=> $mapelM->findAll()
                
            ];

            $view =['form_guru_mapel'=> view('Admin/Guru/Mapel/Edit', $data)];
            echo json_encode($view);
         }
    }

    public function UpdateGuruMapel()
    {
        if ($this->request->isAJAX()) {
            $old_kode = $this->request->getPost('old_kode');
            $kode = $this->request->getPost('kode_guru');
            // Pangil Service Validation 
            $this->validate= \Config\Services::validation();
                $validate = $this->validate(
                [
                'kode_guru' => [
                'label'  => 'Kode Guru Bidang Studi',
                'rules'  => $kode == $old_kode ? 'required': 'required|is_unique[guru_mapel.kode_guru]',
                'errors' => [
                'required' => '{field} Wajib di isi',
                'is_unique' => '{field} Telah digunakan.',
                ]
                ],
                'guru' => [
                'label'  => 'Guru',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'mapel' => [
                'label'  => 'Mata Pelajaran',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ],
                'kelas' => [
                'label'  => 'Kelas',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Wajib di isi'
                ]
                ]
                
                ]
                );
        // Jika Tidak Tervalidasi, Kembalikan Pesan Error 
        if (!$validate) {
            $response = [
            'error' => [
                'kode_guru' =>$this->validate->getError('kode_guru'),
                'guru' => $this->validate->getError('guru'),
                'mapel' => $this->validate->getError('mapel'),
                'kelas' => $this->validate->getError('kelas')
            ]
            ];
            }else{

                // Ambil data dari form atau input
                $id = $this->request->getPost('id');
                $sekolahId = $this->request->getPost('sekolah_id');
                $periodeId = $this->request->getPost('periode_id');
                $guruId = $this->request->getPost('guru');
                $mapelId = $this->request->getPost('mapel');
                $kelasId = $this->request->getPost('kelas');

                // Periksa keunikan kombinasi kolom
        if (!$this->guruMapelM->isCombinationUnique($sekolahId, $periodeId, $guruId, $mapelId, $kelasId, $id)) {
            // Tampilkan pesan error bahwa kombinasi kolom tidak unik
            $response = [
                'error' => [
                    'guru' => 'Terdapat Data ganda',
                    'mapel' => 'Terdapat Data ganda',
                    'kelas' => 'Terdapat Data ganda',
                ]
                ];
        } else {
            // Lakukan simpan atau update sesuai kebutuhan
            $data = [
                'id'=> $id,
                'sekolah_id'=> $sekolahId,
                'periode_id'=> $periodeId,
                'kode_guru'=> $kode,
                'guru_id'=> $guruId,
                'mapel_id'=> $mapelId,
                'kelas_id'=> $kelasId
                ];
                $this->guruMapelM->save($data);
                $response = [
                    'status'=> 201,
                    'msg' => 'Data Guru Bidang Studi Berhasil disimpan'
                ];

        }

           
        }
           echo json_encode($response);
        }
       
    }
    public function DeleteGuruMapel()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->guruMapelM->delete($id);
            $response = [
                'status'=> 201,
                'msg' => 'Data Dihapus'
            ];
            echo json_encode($response);
        }
    }
    



}