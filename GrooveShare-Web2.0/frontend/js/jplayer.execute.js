//script qui execute le player, c'est ici qu'on stocke la liste des morceaux
         $(document).ready(function(){

                new jPlayerPlaylist({
                    jPlayer: "#jquery_jplayer_2",
                    cssSelectorAncestor: "#jp_container_2"
                }, [
		
                    {
                        title:"The Race",
                        mp3:"http://www.arcane-music.com/sound/The Race.mp3",
                        oga:"http://www.arcane-music.com/sound/The Race.ogg"
                    },
                    {
                        title:"Radiation",
                        mp3:"http://www.arcane-music.com/sound/Radiation.mp3",
                        oga:"http://www.arcane-music.com/sound/Radiation.ogg"
                    }
		
                ], {
                    swfPath: "js",
                    supplied: "oga, mp3",
                    wmode: "window"
                });	



            });