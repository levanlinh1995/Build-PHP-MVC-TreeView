<?php

namespace App\Controllers;

use \Core\Controller;
use App\Classes\myTreeView;
use Symfony\Component\HttpFoundation\JsonResponse;

class TreeEntryController extends Controller
{
    public function index()
    {
        $treeview = new myTreeView();
        $content = $treeview->showCompleteTree();

        $response = new JsonResponse($content);
        $response->send();
    }
}