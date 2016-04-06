<?php
namespace Controller;

class Index extends \Controller
{

    /**
     * GET /
     * @param  \Base $fw
     */
    function index(\Base $fw)
    {
        $video = new \Model\Video;

        $new = $video->find([], ['order' => 'date_added DESC', 'limit' => 6]);
        $fw->set('new', $new);
        $top = $video->find([], ['order' => 'views DESC', 'limit' => 6]);
        $fw->set('top', $top);
        
        $this->render('index.html');
    }

    /**
     * GET /top
     * @param  \Base $fw
     * @param  array $params
     */
    function top(\Base $fw, array $params)
    {
        $video = new \Model\Video;

        $list = $video->find([], ['order' => 'views DESC', 'limit' => 30]);
        $fw->set('list', $list);

        $fw->set('title', 'Most Played');
        $this->render('list.html');
    }

    /**
     * GET /latest
     * @param  \Base $fw
     * @param  array $params
     */
    function latest(\Base $fw, array $params)
    {
        $video = new \Model\Video;

        $list = $video->find([], ['order' => 'date_added DESC', 'limit' => 30]);
        $fw->set('list', $list);

        $fw->set('title', 'Latest Videos');
        $this->render('list.html');
    }

    /**
     * GET /searchk
     * @param  \Base $fw
     */
    function search(\Base $fw)
    {
        if($fw->get('GET.q') == '') {
            $fw->reroute('/');
            return;
        }

        $q = '%' . $fw->get('GET.q') . '%';
        $video = new \Model\Video;

        $list = $video->find(['title LIKE ? OR description LIKE ?', $q, $q], ['limit' => 30]);
        $fw->set('list', $list);

        $fw->set('title', 'Search results for "' . $fw->get('GET.q') . '"');
        $this->render('list.html');
    }

}
