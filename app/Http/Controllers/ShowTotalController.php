<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Engineer;
use App\Team;
use App\Project;

class ShowTotalController extends Controller
{
    public function total(){
    	$_engineer = new Engineer();
    	$_team = new Team();
    	$_project = new Project();

    	$_totalTeam = $this->totalTeam($_team);
    	$_totalProject = $this->totalProject($_project);
      $_totalEngineer = $this->totalEngineer($_engineer);
      $_listEngineer = $this->listEngineer($_engineer);
      $_topEngineer = $this->topEngineer($_engineer);
      $_newProject = $this->newProject($_project);

      // dd($_newProject);
    	return view('dashboard')->with([
    			'totalEngineer' => $_totalEngineer,
    			'totalTeam' => $_totalTeam,
    			'totalProject' => $_totalProject,
          'listEngineer' => $_listEngineer,
          'topEngineer' => $_topEngineer,
          'newProject' => $_newProject
    		]);
    }
    
    public function topEngineer($_engineer){
      $_topEngineer = $_engineer->join('History','Engineer.idEngineer','=','History.idEngineer')
                                ->selectRaw('History.idEngineer, Engineer.engineerName, Engineer.TechSkill, Engineer.Experience, COUNT(History.idEngineer) as total')
                                ->distinct('History.idEngineer')
                                ->groupBy('History.idEngineer')
                                ->orderBy('total','desc')
                                ->take(5)
                                ->get();
      return $_topEngineer;
    }

    public function newProject($_project){
      $_newProject = $_project->selectRaw('idProject, projectName')
                              ->orderBy('dateOfBegin','desc')
                              ->take(6)
                              ->get();
      return $_newProject;
    }

    public function listEngineer($_engineer){
      $_listEngineer = $_engineer->get();
      return $_listEngineer;
    }

    public function totalEngineer($_engineer){
      $_totalEngineer = $_engineer->count();
      return $_totalEngineer;
    }

    public function totalProject($_project){
      $_totalProject = $_project->count();
      return $_totalProject;
    }

    public function totalTeam($_team){
      $_totalTeam = $_team->count();
      return $_totalTeam;
    }
}






// ===================================================================
// SELECT h.idEngineer, e.engineerName, COUNT(h.idEngineer) numbers 
// FROM Engineer AS e
// INNER JOIN History AS h 
// ON e.idEngineer = h.idEngineer
// GROUP BY idEngineer
// ORDER BY numbers DESC
// LIMIT 5