<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class JobsController extends Controller
{

    public function _display_sample_form() {
    $data = [];

    $data = ['jlg_grouping' 	=> $this->JLG_GROUPING_ARR,
         'asset_types'  	=> $this->ASSET_ARR,
         'area_types'		=> $this->AREA_TYPE_ARR,
         'default_jlg'		=> $this->DEFAULT_JLG,
         'default_asset'	=> $this->DEFAULT_ASSET,
         'default_area_type' => $this->DEFAULT_AREA_TYPE];

    # NEW - fetching Interest-Rate(s) [Begin]
      $int_rates = _fetchMinMaxInterestRates();
      $data['int_rates'] = $int_rates;
    # NEW - fetching Interest-Rate(s) [End]

    return view('pages.swagatam.sample-form', $data);
   }

    public function _display_sample_CRUD() {
     $data = [];
    return view('pages.swagatam.sample-CRUD', $data);
    }

    public function get_zone(Request $request){
        $id = $request->get('id');
        $region = DB::table('master_office')->where('e_office_type',$id)->get();
        return response()->json_encode(['menu'=>$region]);

    }
    public function get_region(Request $request){
        $id = $request->get('i_id');
        $branch = DB::table('master_office')->where('e_office_name',$id)->get();
        return response()->json_encode(['menu'=>$branch]);
    }

    public function index()
    {
      return view('manageJobs.jobs-posting');
    }
#FUNCTION TO RETURN DATA
    public function get_data()
    {
        $region = DB::table('master_office')->where('e_office_type','REGIONAL')->distinct('s_office_name')->get();
        $zone = DB::table('master_office')->where('e_office_type','ZONAL')->distinct('s_office_name')->get();
        $branch = DB::table('master_office')->where('e_office_type','BRANCH')->distinct('s_office_name')->get();
        $data = $result = DB::table('master_jobs')
            ->join('master_office','master_office.s_office_code','=','master_jobs.job_branch')
            ->get();

        return response()->json([
            'zone'=>$zone,
            'region'=>$region,
            'branch'=>$branch,
            'data'=>$data,
        ]);
    }
#FUNCTION TO SEARCH DATA
    public function search_data(Request $request)
    {
        $zone = $request->input('jobZone');
        $region = $request->input('jobRegion');
        $branch = $request->input('jobBranch');

        $j =  '30002 ';

        $data = $result = DB::table('master_jobs')->join('master_office','master_office.s_office_code','=','master_jobs.job_branch')
        ->where('job_zone', $zone)->where('job_region',$region)->where('job_branch',$branch)
            ->get();

        if(count($data)){

            $region = DB::table('master_office')->where('e_office_type','REGIONAL')->distinct('s_office_name')->get();
            $zone = DB::table('master_office')->where('e_office_type','ZONAL')->distinct('s_office_name')->get();
            $branch = DB::table('master_office')->where('e_office_type','BRANCH')->distinct('s_office_name')->get();
             return response()->json($data);

        } else {

          $this->get_data();

        }
    }
    #FUNCTION TO ADD NEW JOB
    public function add_new_job()
    {
        $region = DB::table('master_office')->where('e_office_type','REGIONAL')->distinct('s_office_name')->get();
        $zone = DB::table('master_office')->where('e_office_type','ZONAL')->distinct('s_office_name')->get();
        $branch = DB::table('master_office')->where('e_office_type','BRANCH')->distinct('s_office_name')->get();
        return view('manageJobs.partials.add-job-form')->with([
            'region'=>$region,
            'zone'=>$zone,
            'branch'=>$branch,
        ]);
    }

    public function store_job_page(){
        return view('Admin.add-job-page');
    }

    public function store_job(Request $request)
    {
        $request->validate([
            'jobTitle'=>'required',
            'jobZone'=>'required',
            'jobRegion'=>'required',
            'jobBranch'=>'required',
            'jobValidityDate'=>'required',
            'jobEffectiveDate'=>'required',
            'jobDescription'=>'required',
            'jobCreatedBy'=>'required',
            'jobUpdatedBy'=>'required',
            'jobZone'=>'required',
        ]);

        $data = array([
            'job_title'=>$request->input('jobTitle'),
            'job_code'=>'JOB_'.time(),
            'job_link'=>url('jobLink'),
            'job_zone'=>$request->input('jobZone'),
            'job_region'=>$request->input('jobRegion'),
            'job_branch'=>$request->input('jobBranch'),
            'job_validity_date'=>$request->input('jobValidityDate'),
            'job_effective_date'=>$request->input('jobEffectiveDate'),
            'job_description'=>$request->input('jobDescription'),
            'job_created_by'=>$request->input('jobCreatedBy'),
            'job_updated_by'=>$request->input('jobUpdatedBy'),


        ]);

        $result = DB::table('master_jobs')->insert($data);
        if($result){
            return back()->with('message','Job Inserted');
        }

    }
    public function delete(Request $request)
    {
        $id = $request->input('id') ;
        $result = DB::table('master_jobs')->where('job_id',$id)->get();
        if($result){
            $result = DB::table('master_jobs')->where('job_id',$id)->delete();
            return 1;
        } else {
            return 0;
        }

    }
    public function edit($id)
    {
        $region = DB::table('master_office')->where('e_office_type','REGIONAL')->distinct('s_office_name')->get();
        $zone = DB::table('master_office')->where('e_office_type','ZONAL')->distinct('s_office_name')->get();
        $branch = DB::table('master_office')->where('e_office_type','BRANCH')->distinct('s_office_name')->get();
        $result = DB::table('master_jobs')->where('job_id',$id)->get();
        return view('manageJobs.partials.edit-job')->with([
            'region'=>$region,
            'zone'=>$zone,
            'branch'=>$branch,
            'result'=>$result
        ]);

    }
    public function view($id)
    {
        $result = DB::table('master_jobs')->where('job_id',$id)->get();
        return view('manageJobs.partials.view-job')->with(['result'=>$result]);
    }
    public function update(Request $request){

        $id = $request->input('id');
        $request->validate([
            'jobTitle'=>'required',
            'jobZone'=>'required',
            'jobRegion'=>'required',
            'jobValidityDate'=>'required',
            'jobEffectiveDate'=>'required',
            'jobDescription'=>'required',
            'jobCreatedBy'=>'required',
            'jobUpdatedBy'=>'required',
        ]);

        $data = array([
            'job_title'=>$request->input('jobTitle'),
            'job_code'=>'JOB_'.time(),
            'job_region'=>$request->input('jobRegion'),
            'job_validity_date'=>$request->input('jobValidityDate'),
            'job_effective_date'=>$request->input('jobEffectiveDate'),
            'job_description'=>$request->input('jobDescription'),
            'job_created_by'=>$request->input('jobCreatedBy'),
            'job_updated_by'=>$request->input('jobUpdatedBy'),
            'job_zone'=>$request->input('jobZone'),
            'job_branch'=>$request->input('jobRegion'),
        ]);

        $result = DB::table('master_jobs')->where('job_id',$id)->update(
            [
                'job_title'=>$request->input('jobTitle'),
                'job_code'=>'JOB_'.time(),
                'job_region'=>$request->input('jobRegion'),
                'job_validity_date'=>$request->input('jobValidityDate'),
                'job_effective_date'=>$request->input('jobEffectiveDate'),
                'job_description'=>$request->input('jobDescription'),
                'job_created_by'=>$request->input('jobCreatedBy'),
                'job_updated_by'=>$request->input('jobUpdatedBy'),
                'job_zone'=>$request->input('jobZone'),
                'job_branch'=>$request->input('jobRegion'),
            ]
        );
        if($result){
            return back()->with('message','Job Inserted');
        }
    }
}
