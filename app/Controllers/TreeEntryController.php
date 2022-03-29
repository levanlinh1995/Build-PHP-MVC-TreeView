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

    public function getRootEntry()
    {
        $treeview = new myTreeView();
        $children = $treeview->showAjaxTree();

        $response = new JsonResponse($children);
        $response->send();
    }

    public function getChildren($id)
    {
        $treeview = new myTreeView();
        $children = $treeview->fetchAjaxTreeNode($id);

        $response = new JsonResponse($children);
        $response->send();
    }
}