<?php
    class Youtube  
    {       
        const re = "/(?:http(?:s)?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"\'<> #]+)/mi"; 
        private $URL_link ; # exemple https://www.youtube.com/watch?v=mkggXE5e2yk&t
        private $id  ;
        private $title ;   # exemple : Real 4K HDR 60fps: LG Jazz HDR UHD (Chromecast Ultra)
        private $URL_download ;
        private $info ;
        private $status_video ;
        private $monpath_filename ;
    
        public function __CONSTRUCT ($URL_link)
        {

            $this -> URL_link = $URL_link ;
            
        }   

        public function url_link()
        {
            if  (preg_match_all (self::re, $this -> URL_link, $matches, PREG_SET_ORDER, 0) != false)   # si 0 alors le url_link n 'est pas  conforme 
            {
                echo "link_URL OK !" .PHP_EOL ;
                $this -> id = $matches[0][1] ; # id de la video
                
                return true ;
            }
            else 
            {
                echo "link_URL NOT OK !" .PHP_EOL ;
                return false ; 
            }
            
            
        }
        public function infovideo()
        {
            parse_str(file_get_contents("http://youtube.com/get_video_info?video_id=" . $this-> id ), $infos  ); //decode the data vers  array
            $this -> info = $infos ;
            
            echo "je recupere les informations" . PHP_EOL;
        }


        public function status_video_check()
        {
            echo "status" . PHP_EOL;
                      
            $this -> status_video = $this -> info['status']; #mise a jour de status
            if ($this -> status_video == "ok")
            {
                echo "Status est : " . $this -> status_video  . PHP_EOL ;   # $info['status'] = ok
                return true ;
            }
            else 
            {
                return false ;

            }
                        
        }

        public function set_url_link_download()
        {
            $video = "" ;
            $infos = $this-> info ;
            $videoData = json_decode($infos['player_response'], true); // structure $info en format json plus lisible
            $this -> title = $videoData['videoDetails']['title'] ;  # titre de la video
            
            $streamingData = $videoData['streamingData'];
            $streamingDataFormats = $streamingData['formats'];
            $video = $streamingDataFormats[1]['url'];  # hd720
            $this -> url_link_download = $video ;
        }

        public function get_url_link_download() 
        {

            return $this -> url_link_download ;
        }

        public function get_title()
        {
            return $this -> title ;
        }

        public function set_file_name ($title , $path)
        {
            $t = (array_unique(explode(" " , $title))) ; # supprime les mots en doublons et 
            # remplace les espaces par _
            $arr = implode("_",array_slice($t ,0 , count($t)/3)) ; # ne renvoi que les premier mots
            $this -> monpath_filename =  $path . $arr .".mp4" ;
            echo ($this -> monpath_filename . PHP_EOL ) ; 

        }

        public function get_monpath_filename() {

            return $this -> monpath_filename ;

        }


        public function download($link_url , $filename)
        {   
            
            file_put_contents($filename, fopen($link_url, 'r' )); # telechargement et enregistrement mp4
            echo ($filename . '  Video Download finished ! ' . PHP_EOL);
        }


        public function conversion_mp3($videomp4) 
        {
            $videomp4 = str_replace("/" , "\\" ,$videomp4);  # on remplace le backslash / par \ pour etre compatible windows
            echo "Conversion de la video " . $videomp4 . PHP_EOL ;
            $parametre = "ffmpeg -y -nostats -loglevel 0 -i " . $videomp4 . " -vn " .  str_replace("mp4" , "mp3" , $videomp4) ; 
            # -y force overwrite
            # -nostats -loglevel 0 ffmeg en mode silence !
            echo ($parametre . PHP_EOL) ;
            system($parametre) ; # execute ffmeg en ligne de commande pour windows 
            echo ('Audio Download finished ! ' . PHP_EOL);
            
        } 


}

/*
les infos  $monpath et le lien
*/

$monpath = "D:/youtube/" ;  # ou seont enregistres les fichiers mp4 et mp3
$linkYoutube = "https://youtu.be/2J7xlDH4QkA" ;
$mavideo = new Youtube ($linkYoutube) ; # le lien youtube

if ($mavideo -> url_link() == true )  # le lien est conforme
{
    echo "le lien est conforme " . PHP_EOL ;
    $mavideo -> infovideo(); #recupere les infos
    if ($mavideo -> status_video_check() == true)
    {
        $mavideo -> set_url_link_download() ; # le lien de telechargement
        echo($mavideo -> get_url_link_download() . PHP_EOL) ; # affiche le lien de telechargement
        print_r($mavideo -> get_title() . PHP_EOL ) ;
        $mavideo -> set_file_name( $mavideo -> get_title() , $monpath) ; # nom et path du fichier qui sera enregistre
        $mavideo -> download( $mavideo -> get_url_link_download() , $mavideo -> get_monpath_filename()) ; # on download et on enregistre
        $mavideo -> conversion_mp3($mavideo -> get_monpath_filename()) ;
        
    }

}



