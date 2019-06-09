<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RepositoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request) {
        $repositories = $request->auth->repositories;

        return response()->json([
            'repositories' => $repositories
        ], 200);
    }

    /**
     * Clones a repository using the users supplied ssh key
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clone(Request $request) {
        //Clone the repo using the ssh key for the user
        $remote_git_repo = $request->url;
        $repo_name = explode('.',explode('/',$remote_git_repo)[count(explode('/',$remote_git_repo))-1])[0];
        $local_git_repo = storage_path('app/'.$request->auth->id.'/git/'.$repo_name);
        $ssh_key = storage_path('app/'.$request->auth->id.'/ssh/git_ssh');

        //Run clone
        $process = new Process('GIT_SSH_COMMAND="ssh -i '.$ssh_key.'" git clone '.$remote_git_repo.' '.$local_git_repo);
        $process->run();

        //If fails show issue
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        //Create a repo object to keep track
        $repository = new Repository();
        $repository->local_location = $local_git_repo;
        $repository->remote_location = $remote_git_repo;
        $repository->user_id = $request->auth->id;
        $repository->save();

        return response()->json([
            'message' => 'Your repository was cloned successfully.'
        ], 200);
    }
}
