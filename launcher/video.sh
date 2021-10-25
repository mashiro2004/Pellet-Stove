#!/bin/sh
ffmpeg -t 5 -f v4l2 -framerate 25 -video_size 640x80 -i /dev/video0 output.mkv

 
