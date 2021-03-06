<?php
namespace Controller;

class Video extends \Controller
{

    /**
     * GET /v/@slug
     * @param  \Base $fw
     * @param  array $params
     */
    function view(\Base $fw, array $params)
    {
        $video = new \Model\Video;
        $video->load(['slug = ?', $params['slug']]);

        if(!$video->id) {
            $fw->error(404);
        }

        // Generate thumbnail if it's missing
        if(!is_file('src/thm/' . $video->slug . '.jpg')) {
            $video->generateThumbnail();
        }
        
        $video->views ++;
        $video->save();
        $fw->set('video', $video);
        $this->render('video/view.html');
    }

}
