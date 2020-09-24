<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Projeto;
use App\Quadro;
use App\TaskFato;
use App\Task;
use App\Kanban;
use App\EquipeUser;
use App\Equipe;

class ExemploChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public ?array $middlewares = ['auth'];

    public function arrumaDados(){
        $user = Auth::user();
        $projetos = Projeto::all();

        $tarefaC = 0;
        $tarefaF = 0;
        $tarefaCc = 0;
        $tarefaFf = 0;
        $arraya = [];
        foreach($projetos as $proj){
            foreach($proj->kanban as $kanban) {
                foreach($kanban->quadros as $quadro){
                    $tarefaF+=$quadro->minhas_tasks_ativas($user->id)->count();
                    $tarefaC+=$quadro->minhas_tasks_finalizadas($user->id)->count();
                    $tarefaFf+=$quadro->tasks_ativas->count();
                    $tarefaCc+=$quadro->tasks_finalizadas->count();
                }

            }
            $arraya[] = [$tarefaCc,$tarefaFf];
        }

        return $arraya[0];
    }
    public function handler(Request $request): Chartisan
    {
        $dados = $this->arrumaDados();
        return Chartisan::build()
            ->labels(['Task Completas', 'Tasks a fazer'])
            ->dataset('tasks', $dados);
            //->dataset('teste 2', [3, 2, 1]);
    }
}
