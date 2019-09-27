<?php
namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Mobile\MobileBaseCrontroller;
use Illuminate\Support\Facades\DB;
use App\Model\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends MobileBaseCrontroller
{
	public function index()
	{
	    return redirect()->route('park')->with(['message'=>'我是传递数据的']);
	    //DB查询  一级为数组  二级为对象
        //model查询 为对象
		$ad = Ad::where(['pid'=>1,'enabled'=>1])->orderBy('orderby','desc')->get();
		$ad1 = Ad::where(['pid'=>5,'enabled'=>1])->orderBy('orderby','desc')->get();
		$ad2 = Ad::where(['pid'=>2,'enabled'=>1])->orderBy('orderby','desc')->get();
        $ad3 = Db::table('ad')->where(['pid'=>3,'enabled'=>1])->orderBy('orderby','desc')->get();
		$notice = Db::table('notice')->where('is_show',1)->orderBy('dateline','desc')->get();
        $cate = Db::table('suppliers_category')
            ->where(array('level'=>1, 'is_show'=>1))
            ->orderBy('category_sort','desc')
            ->get();
		return view('index.index',[
			'ad'=>$ad,
			'ad1'=>$ad1,
			'ad2'=>$ad2,
            'ad3'=>$ad3,
			'notice'=>$notice,
            'cate'=>$cate
		]);
	}
	public function session2(Request $request){
        echo session()->get('key2');
    }
	public function getStoreList(Request $request)
	{
        $where['is_check'] = 1;
        $where['is_recom'] = 1;
        $cate_id = $request->input('cid',0);
        if($cate_id!=0){
            $where['category_id']=$cate_id;
        }
        $search_key = $request->input('search_key');
        if(!empty($search_key)){
            $where['suppliers_name']=array('like','%' . $search_key . '%');
        }
        $count = Db::table('suppliers')
            ->where($where)
            ->count();
        $store = Db::table('suppliers')
            ->where($where)
            ->orderBy('is_hot','desc')
            ->paginate(10);
        $html = '';
        foreach ($store as $val){
            $suppliers_tab = '';
            $suppliers_exp = '';
            $tab= explode('|',$val->suppliers_tab);
            $exp= explode('|',$val->suppliers_exp);
            if(!empty($tab)){
                foreach ($tab as $kk=>$value){
                    $suppliers_tab .= '<label>'.$value.'</label>';
                }
            }
            if(!empty($exp)){
                foreach ($exp as $kk=>$value){
                    $suppliers_exp .= '<label>'.$value.'</label>';
                }
            }
            $html .='<a href="" class="li">'
                .'<div class="li_main"><div class="li_tit fs28">'.$val->suppliers_name.'</div>'
                .'<div class="li_tab fs18">'.$suppliers_tab.'</div>'
                .'<div class="li_txt fs22">'.$suppliers_exp.' </div></div>'
                .'<div class="li_pic"><img src="'.asset($val->suppliers_thumb).'" ></div></a>';
        }
        return response()->json(array('code'=>100,'html'=>$html,'cid'=>$cate_id));
	}
}
?>