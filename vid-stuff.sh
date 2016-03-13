#!/bin/bash
# This is a collection of shell commands for working with video files.

# Determine a mime-type of a file
/usr/bin/file --mime-type -b video.mp4

# Convert an MP4 to WebM
avconv -i video.mp4 video.webm

# Export single frame to image at 00:00:02
# This can be resized later for thumbnails
# Based on: https://devjack.de/how-to-create-thumbnails-of-webm-videos-using-libav-and-the-avconv-tool/
avconv -ss 2 -i video.webm \
  -vsync 1 -r 1 -an -vframes 1 \
  video-frame.png

# Get video duration
avprobe video.webm 2>&1 | grep 'Duration' | awk '{print $2}' | sed s/,//

# Get video resolution
avprobe video.webm 2>&1 | grep 'Video:' | egrep -o '[0-9]+x[0-9]+'
