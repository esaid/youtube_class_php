# youtube_class_php


youtube download video , mp3 conversion (FFMpeg)

il faut installer le programme FFMpeg pour pouvoir convertir le fichier mp4 vers le mp3.

le but de se bout de programme est de montrer en php comment recuperer une video youtube depuis le "link youtube"

exemple dans le programme : 
<p>
/*
les infos  $monpath et le lien
*/

$monpath = "D:/youtube/" ;  # ou seont enregistres les fichiers mp4 et mp3

$linkYoutube = "https://youtu.be/2J7xlDH4QkA" ;

</p>


link_URL OK !

le lien est conforme 

je recupere les informations

status

Status est : ok

https://r1---sn-jxgo-b85l.googlevideo.com/videoplayback?expire=1612737980&ei=XBkgYNedCof61wK3ub3QBQ&ip=128.141.162.83&id=o-AGfDP5ynScCXX83GtTiu2NlUQRuhzrUTkoXcZHw1LlMf&itag=22&source=youtube&requiressl=yes&mh=ds&mm=31%2C29&mn=sn-jxgo-b85l%2Csn-1gi7znes&ms=au%2Crdu&mv=m&mvi=1&pl=16&initcwndbps=16558750&vprv=1&mime=video%2Fmp4&ns=UIDLJLCR-IxOMRIUtXewAPkF&cnr=14&ratebypass=yes&dur=188.197&lmt=1575047869767211&mt=1612716060&fvip=1&c=WEB&txp=5532232&n=-1048K1ztxcf7Dm&sparams=expire%2Cei%2Cip%2Cid%2Citag%2Csource%2Crequiressl%2Cvprv%2Cmime%2Cns%2Ccnr%2Cratebypass%2Cdur%2Clmt&sig=AOq0QJ8wRQIhANvtcxSRN9Oz0gp6UP6t1i0oxZtlSBRjhJ8en1CLlazVAiBl9eEKQ3r2wpj6p8ZvPIGkru7bTszYVrCwxQBG5FJmgw%3D%3D&lsparams=mh%2Cmm%2Cmn%2Cms%2Cmv%2Cmvi%2Cpl%2Cinitcwndbps&lsig=AG3C_xAwRQIgejSimmz26y9n4xzvaGPtw3wYiE5ZN7lY_ljOAhE3qdgCIQDd2aAUfqyxzApFAef78v4pJqOkrOK5Ut5e3RzxMyqnpQ%3D%3D

Real 4K HDR Dolby Test ultrahd movie for 4k oled tv (ULTRAHD HDR 10BIT Dolby Atmos)

D:/youtube/Real_4K_HDR_Dolby.mp4

D:/youtube/Real_4K_HDR_Dolby.mp4  Video Download finished ! 

Conversion de la video D:\youtube\Real_4K_HDR_Dolby.mp4

ffmpeg -y -nostats -loglevel 0 -i D:\youtube\Real_4K_HDR_Dolby.mp4 -vn D:\youtube\Real_4K_HDR_Dolby.mp3

Audio Download finished ! 

Process finished with exit code 0

