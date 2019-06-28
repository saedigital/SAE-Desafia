<?php
/**
 * Created by PhpStorm.
 * User: arbigaus
 * Date: 2019-06-28
 * Time: 12:40
 */

class bookingController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array();

        $books = new Book();
        $shows = new Shows();

        $books->createBook();

        $dados['books'] = $books->getBooks();
        $dados['shows'] = $shows->getShows();

        $this->loadTemplate('booking', $dados);
    }

    public function deleteBook($id)
    {
        $remove = new Book();
        $remove->delBook($id);

        header("Location: /booking");
    }
}