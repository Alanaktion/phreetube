<?php
namespace Helper;

class Video extends \Prefab
{

    /**
     * Generate a unique alphanumeric key
     * @param   int $length
     * @return  string
     */
    function uniqueKey($length = 10) {
        $sha = substr(sha1(microtime()), 0, $length * 2);
        return substr(base_convert($sha, 16, 35), 0, $length);
    }

    /**
     * Get a video file's duration in seconds
     * @param   string $file
     * @return  int
     */
    function getDuration($file) {
        $file = 'src/vid/' . $file;
        $result = shell_exec("avprobe " . escapeshellarg($file) . " 2>&1 | grep 'Duration' | awk '{print $2}' | sed s/,//");
        $parts = explode(':', trim($result));
        $time = ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
        return $time;
    }

    /**
     * Generate a scaled and cropped 16:9 thumbnail for a video file
     * @param   string $file
     * @param   string $slub
     * @param   float $position  Position in the video as decimal percent
     * @return  string           Thumbnail filename
     */
    function generateThumbnail($file, $slug, $position = 0.3) {
        $time = ceil($this->getDuration($file) * $position);
        $file = 'src/vid/' . $file;

        // Generate poster
        $thm = 'src/thm/' . $slug . '.jpg';
        shell_exec("avconv -ss " . escapeshellarg($time) . " -i " . escapeshellarg($file) . " -vsync 1 -r 1 -an -vframes 1 " . escapeshellarg($thm));

        // Generate thumbnail
        $thm = 'src/thm/' . $slug . '_t.jpg';
        shell_exec("avconv -ss " . escapeshellarg($time) . " -i " . escapeshellarg($file) . " -vsync 1 -r 1 -an -vframes 1 -filter 'scale=384:-1,crop=384:216' " . escapeshellarg($thm));

        return $slug . '.jpg';
    }

}
