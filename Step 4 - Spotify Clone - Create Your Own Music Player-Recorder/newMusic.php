<?php
include("includes/includedFiles.php");

?>

<html>
<head>

<script src="./assets/js/newMusic.js"></script>	
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/newMusic.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="sweetalert2.all.min.js" charset="UTF-8"></script>    
</head>
<body>

<div class="playlistsContainer">
    <div class="gridViewContainer">
        <h2>MIX YOUR MUSIC</h2>

        <div class="buttonItems">
            <button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
        </div>
            <div class="load-track-wrapper">
                <h2>Available Tracks</h2>
                <select name="savailable-tracks" class="available-tracks">
                </select>
            </div>
            <div class="load-track-buttons">
                <button class="load-track hidden button">Load Track</button>
                <button class="delete-track hidden button">Delete Track</button>
            </div>           
    </div>
</div>

          <div id="box">
            <div id="star1"></div>
            <div id="sun" title="Sun *Star*"></div>
            <div id="star2"></div>
            <div id="star3"></div>
        </div>
          

      
        <div class="muzieknootjes">
            <div class="noot-1">
            &#9835; &#9833;
          </div>
          <div class="noot-2">
            &#9833;
          </div>
          <div class="noot-3">
            &#9839; &#9834;
          </div>
          <div class="noot-4">
            &#9834;
          </div>

          <div class="noot-5">
            &#9835; &#9833;
          </div>
          <div class="noot-6">
            &#9833;
          </div>
          <div class="noot-7">
            &#9839; &#9834;
          </div>
          <div class="noot-8">
            &#9834;
          </div>

          <div class="noot-9">
            &#9835; &#9833;
          </div>
          <div class="noot-10">
            &#9833;
          </div>
        </div> 

        
          

        <div class="sequencer">
           
            <div class="playert">
                <img class="newMusicVolume" src="assets/images/icons/volume.png">
                <div class="volumet"></div>
            </div>

            <!-- <div class="container-for-side"></div> -->
         

            <!-- SONG -->
            <div class="song-track">
                <div class="controls">
                    <h2>Song</h2>
                    <button data-track="0" class="mute song-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="ssong-select" id="song-select" class="select">
                        <option value="./sounds/ElectroDanger.wav">Electro Danger</option>
                        <option value="./sounds/BassMatch.wav">Bass Match</option>
                        <option value="./sounds/EnergeticJungle.wav">Energetic Jungle</option>
                        <option value="./sounds/RockingClub.wav">Rocking Club</option>
                        <option value="./sounds/SpeedChallenge.wav">Speed Challenge</option>
                        <option value="./sounds/TakeControl.wav">Take Control</option>
                        <option value="./sounds/ThatBass.wav">That Bass</option>
                        <option value="./sounds/TrapandStrings.wav">Trap and Strings</option>
                        <option value="" id="src">- Your tmp tracks below - Refresh page to delete -</option>              
                    </select>    

                        <form id="formupload" action="uploadHandler.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="file" size="1000000" id="divFileInput" />
                            <br />
                            <input type="submit" class="button" id="fileBtn" value="Upload File" name="submit"/>
                        </form>                   
                    </div>

                    <div class="song set">
                        <div class="pad song-pad b0 long">
                            <h1></h1>
                        </div>
                    </div>
                </div>

            <!-- CLAP -->

            <div class="clap-track">
                <div class="controls">
                    <h2>Clap</h2>
                    <button data-track="0" class="mute clap-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="sclap-select" id="clap-select" class="select">
                        <option value="./sounds/clap-808.wav">808 Clap</option>
                        <option value="./sounds/clap-analog.wav">Analog Clap</option>
                        <option value="./sounds/clap-crushed.wav">Crushed Clap</option>
                        <option value="./sounds/clap-fat.wav">Fat Clap</option>
                        <option value="./sounds/clap-slapper.wav">Slapper Clap</option>
                        <option value="./sounds/clap-tape.wav">Tape Clap</option>
                    </select>

                    <div class="player2">
                        <div class="volume2"></div>
                    </div>
                </div>

                <div class="clap set">
                    <div class="pad clap-pad b0"></div>
                    <div class="pad clap-pad b1"></div>
                    <div class="pad clap-pad b2"></div>
                    <div class="pad clap-pad b3"></div>
                    <div class="pad clap-pad b4"></div>
                    <div class="pad clap-pad b5"></div>
                    <div class="pad clap-pad b6"></div>
                    <div class="pad clap-pad b7"></div>
                    <div class="pad clap-pad b8"></div>
                    <div class="pad clap-pad b9"></div>
                </div>
            </div>

            <!-- KICK -->

            <div class="kick-track">
                <div class="controls">
                    <h2>Kick</h2>
                    <button data-track="1" class="mute kick-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="skick-select" id="kick-select" class="select">
                        <option value="./sounds/kick-808.wav">808 Kick</option>
                        <option value="./sounds/kick-classic.wav">Classic Kick</option>
                        <option value="./sounds/kick-vinyl01.wav">Vinyl Kick</option>
                        <option value="./sounds/kick-acoustic01.wav">Acoustic Kick 1</option>
                        <option value="./sounds/kick-acoustic02.wav">Acoustic Kick 2</option>
                        <option value="./sounds/kick-big.wav">Big Kick</option>
                        <option value="./sounds/kick-deep.wav">Deep Kick</option>
                        <option value="./sounds/kick-dry.wav">Dry Kick</option>
                        <option value="./sounds/kick-electro01.wav">Electro Kick</option>
                        <option value="./sounds/kick-heavy.wav">Heavy Kick</option>
                        <option value="./sounds/kick-oldschool.wav">Old School Kick</option>
                        <option value="./sounds/kick-tape.wav">Tape Kick</option>
                        <option value="./sounds/kick-tron.wav">Tron Kick</option>
                    </select>

                    <div class="player3">
                        <div class="volume3"></div>
                    </div>
                </div>

                <div class="kick set">
                    <div class="pad kick-pad b0"></div>
                    <div class="pad kick-pad b1"></div>
                    <div class="pad kick-pad b2"></div>
                    <div class="pad kick-pad b3"></div>
                    <div class="pad kick-pad b4"></div>
                    <div class="pad kick-pad b5"></div>
                    <div class="pad kick-pad b6"></div>
                    <div class="pad kick-pad b7"></div>
                    <div class="pad kick-pad b8"></div>
                    <div class="pad kick-pad b9"></div>
                </div>
            </div>

            <!-- SNARE -->

            <div class="snare-track">
                <div class="controls">
                    <h2>Snare</h2>
                    <button data-track="2" class="mute snare-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="ssnare-select" id="snare-select" class="select">
                        <option value="./sounds/snare-808.wav">808 Snare</option>
                        <option value="./sounds/snare-acoustic01.wav">Acoustic Snare</option>
                        <option value="./sounds/snare-vinyl02.wav">Vinyl Snare</option>
                        <option value="./sounds/snare-analog.wav">Analog Snare</option>
                        <option value="./sounds/snare-big.wav">Big Snare</option>
                        <option value="./sounds/snare-electro.wav">Electro Snare</option>
                        <option value="./sounds/snare-lofi01.wav">Lo-fi Snare</option>
                        <option value="./sounds/snare-punch.wav">Punch Snare</option>
                        <option value="./sounds/snare-tape.wav">Tape Snare</option>
                    </select>

                    <div class="player4">
                        <div class="volume4"></div>
                    </div>
                </div>

                <div class="snare">
                    <div class="pad snare-pad b0"></div>
                    <div class="pad snare-pad b1"></div>
                    <div class="pad snare-pad b2"></div>
                    <div class="pad snare-pad b3"></div>
                    <div class="pad snare-pad b4"></div>
                    <div class="pad snare-pad b5"></div>
                    <div class="pad snare-pad b6"></div>
                    <div class="pad snare-pad b7"></div>
                    <div class="pad snare-pad b8"></div>
                    <div class="pad snare-pad b9"></div>
                </div>
            </div>

            <!-- TOM -->

            <div class="tom-track">
                <div class="controls">
                    <h2>Tom</h2>
                    <button data-track="3" class="mute tom-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="stom-select" id="tom-select" class="select">
                        <option value="./sounds/tom-808.wav">808 Tom</option>
                        <option value="./sounds/tom-acoustic01.wav">Acoustic Tom</option>
                        <option value="./sounds/tom-analog.wav">Analog Tom</option>
                        <option value="./sounds/tom-chiptune.wav">Chiptune Tom</option>
                        <option value="./sounds/tom-fm.wav">FM Tom</option>
                        <option value="./sounds/tom-lofi.wav">Lo-fi Tom</option>
                        <option value="./sounds/tom-rototom.wav">Rototom Tom</option>
                        <option value="./sounds/tom-short.wav">Short Tom</option>
                    </select>

                    <div class="player5">
                        <div class="volume5"></div>
                    </div>
                </div>

                <div class="tom">
                    <div class="pad tom-pad b0"></div>
                    <div class="pad tom-pad b1"></div>
                    <div class="pad tom-pad b2"></div>
                    <div class="pad tom-pad b3"></div>
                    <div class="pad tom-pad b4"></div>
                    <div class="pad tom-pad b5"></div>
                    <div class="pad tom-pad b6"></div>
                    <div class="pad tom-pad b7"></div>
                    <div class="pad tom-pad b8"></div>
                    <div class="pad tom-pad b9"></div>
                </div>
            </div>

            <!-- HIHAT -->

            <div class="hihat-track">
                <div class="controls">
                    <h2>Hi-Hat</h2>
                    <button data-track="4" class="mute hihat-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="shihat-select" id="hihat-select" class="select">
                        <option value="./sounds/hiat-808.wav">808 HiHat</option>
                        <option value="./sounds/hihat-acoustic01.wav">Acoustic HiHat</option>
                        <option value="./sounds/hihat-analog.wav">Analog HiHat</option>
                        <option value="./sounds/hihat-digital.wav">Digital HiHat</option>
                        <option value="./sounds/hihat-dist01.wav">Dist HiHat</option>
                        <option value="./sounds/hihat-electro.wav">Electro HiHat</option>
                        <option value="./sounds/hihat-plain.wav">Plain HiHat</option>
                        <option value="./sounds/hihat-reso.wav">Reso HiHat</option>
                        <option value="./sounds/hihat-ring.wav">Ring HiHat</option>
                    </select>

                    <div class="player6">
                        <div class="volume6"></div>
                    </div>
                </div>

                <div class="hihat">
                    <div class="pad hihat-pad b0"></div>
                    <div class="pad hihat-pad b1"></div>
                    <div class="pad hihat-pad b2"></div>
                    <div class="pad hihat-pad b3"></div>
                    <div class="pad hihat-pad b4"></div>
                    <div class="pad hihat-pad b5"></div>
                    <div class="pad hihat-pad b6"></div>
                    <div class="pad hihat-pad b7"></div>
                    <div class="pad hihat-pad b8"></div>
                    <div class="pad hihat-pad b9"></div>
                </div>
            </div>

            <!-- COWBELL -->

            <div class="cowbell-track">
                <div class="controls">
                    <h2>Cowbell</h2>
                    <button data-track="5" class="mute cowbell-volume">
                        <i class="fas fa-volume-mute"></i>
                    </button>
                    <select name="scowbell-select" id="cowbell-select" class="select">
                        <option value="./sounds/cowbell-808.wav">808 Cowbell</option>
                    </select>

                    <div class="player7">
                        <div class="volume7"></div>
                    </div>
                </div>

                <div class="cowbell">
                    <div class="pad cowbell-pad b0"></div>
                    <div class="pad cowbell-pad b1"></div>
                    <div class="pad cowbell-pad b2"></div>
                    <div class="pad cowbell-pad b3"></div>
                    <div class="pad cowbell-pad b4"></div>
                    <div class="pad cowbell-pad b5"></div>
                    <div class="pad cowbell-pad b6"></div>
                    <div class="pad cowbell-pad b7"></div>
                    <div class="pad cowbell-pad b8"></div>
                    <div class="pad cowbell-pad b9"></div>
                </div>
            </div>         
        </div>

            <audio class="song-sound vol" id="vol" src="./sounds/ElectroDanger.wav"></audio>
            <audio class="clap-sound vol" id="vol2" src="./sounds/clap-808.wav"></audio>
            <audio class="kick-sound vol" id="vol3" src="./sounds/kick-808.wav"></audio>
            <audio class="snare-sound vol" id="vol4" src="./sounds/snare-808.wav"></audio>
            <audio class="tom-sound vol" id="vol5" src="./sounds/tom-808.wav"></audio>
            <audio class="hihat-sound vol" id="vol6" src="./sounds/hihat-808.wav"></audio>
            <audio class="cowbell-sound vol" id="vol7" src="./sounds/cowbell-808.wav"></audio>
       
            <div class="playingBarContainer">
                <div class="play-and-tempo">
                    <div class="tempo">
                            <input type="range" class="tempo-slider" max="300" min="20" value="150">
                            <p>Tempo: <span class="tempo-nr">150</span></p>
                    </div>


            <button class="plays"><i class="fas fa-play"></i></button>
            <button class="save-track button">Save Track</button>

                <div class="save-track-inputs hidden">
                    <input
                        type="text"
                        name="itrack-name"
                        class="track-name shaped"
                        placeholder="Track Name"/>

                    <button class="save-name button">Save</button>
                </div>
           
        </div>
    </div>

     
       
    <!-- <script src="./assets/js/newMusic.js"></script> -->

    <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>

       
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>

    </div>

		<?php include("includes/nowPlayingBar.php"); ?>

	</div>
	<script
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
            integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs="
            crossorigin="anonymous">
        </script>

</body>
