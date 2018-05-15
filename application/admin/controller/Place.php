<?php
namespace app\admin\controller;

use think\Controller;

class Place extends Controller
{
    public function index()
    {

        return $this->fetch('index');
    }
    public function edit()
    {

        return $this->fetch('edit');
    }
    /**
     * 渲染增加驾校模板
     */
    public function add()
    {
        return view('add');
    }

    /**
     * 增加驾校或者体验站的地址
     */
    public function editAction()
    {
        $returnArray =array();
        $driversModel = new \app\admin\model\Drivers();

        if($_POST['name']){
            $data['drive_name'] = $_POST['name'];
        }else{
            $returnArray = array(
                 'code' => 100001,
                 'msg' => $driversModel::ERROR_CODE[100001],
                 'data' => array()
            );
        }

        if($_POST['address']){
            $data['site'] = $_POST['address'];
        }else{
            $returnArray = array(
                'code' => 100001,
                'msg' => $driversModel::ERROR_CODE[100001],
                'data' => array()
            );
        }

        if($_POST['telephone']){
            $data['phone'] = $_POST['telephone'];
        }else{
            $returnArray = array(
                'code' => 100001,
                'msg' => $driversModel::ERROR_CODE[100001],
                'data' => array()
            );
        }


        if($_POST['lng']){
            $data['lng'] = $_POST['lng'];
        }else{
            $returnArray = array(
                'code' => 100001,
                'msg' => $driversModel::ERROR_CODE[100001],
                'data' => array()
            );
        }

        if($_POST['lat']){
            $data['lat'] = $_POST['lat'];
        }else{
            $returnArray = array(
                'code' => 100001,
                'msg' => $driversModel::ERROR_CODE[100001],
                'data' => array()
            );
        }

        if(empty($returnArray)){
            $result = $driversModel->create($data);
            if($result)
            {
                $returnArray = array(
                    'code' => 1,
                    'msg' => $driversModel::ERROR_CODE[1],
                    'data' => $result
                );

            }
        }
        return json_encode($returnArray);
    }

    /**
     * @return booly验证手机号
     * @ telephone POST  手机号
     */
    public function verifyPhone(){
        if(isset($_POST['telephone']) && !empty($_POST['telephone']))
        {
            $verifyModel = new \app\admin\model\Verify();
            $result = $verifyModel->verifyTelephone($_POST['telephone']);
            if($result)
            {
                return true;
            }else{
                return false;
            }
        }


    }

    /**
     * 验证经纬度
     *  lat float  纬度
     * lng float 经度
     */

    public function verifyLatlng()
    {
        if(isset($_POST['lat']) && !empty($_POST['lat']))
        {

            if(0< $_POST['lat'] && $_POST['lat']<90 )
            {
                return true;
            }else{
                return false;
            }
        }

        if(isset($_POST['lng']) && !empty($_POST['lng']))
        {
            if(-180 < $_POST['lng'] && $_POST['lng'] < 180 )
            {
                return true;
            }else{
                return false;
            }
        }

    }

}
