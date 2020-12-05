// Include Swal Sweet alert cdn
var jQueryScript = document.createElement('script');  
jQueryScript.setAttribute('src','https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js');
document.head.appendChild(jQueryScript);

    
    // turned On alert to do the following actions after submit form is selected
    $('#formupload').on('submit',function(e){
        e.preventDefault();

        // Determining the inputed value to push to new song elements
        var formData = new FormData(this);

        var inputedSong = document.getElementById("divFileInput").value;
        
        var res = inputedSong.substring(12);
        res = './sounds/' + res;        
        var songsContainer = document.getElementById("song-select");

        // Creating option attributes and Appending new option element holding song element to songlist
        var srcTextSliced = res.substring(9);
        newAddedFixedString = res.substring(9);
        newAddedSong = document.createElement('option');
        newAddedSong.setAttribute('className', 'test');
        newAddedSong.setAttribute('value', res);        
        newAddedSongText = newAddedSong.innerHTML = srcTextSliced;

         //TODO
        // localSong = newAddedSongText.substring(0, newAddedSongText.length - 4);
        // localStorage.setItem('mySongs', JSON.stringify(newAddedSong));
        // localSong = JSON.parse(localStorage.getItem('mySongs'));
        // console.log(newAddedSong);
       
        newAddedSongAmended = document.getElementsByClassName('test').innerHTML = newAddedFixedString;
        var newAddedSongType = srcTextSliced.substring(newAddedFixedString.length - 3);

        var http = new XMLHttpRequest();

        // File size attributes
        var fileSize = document.getElementById("divFileInput").files[0]; 

            if (fileSize.size > 10000000) {
                swal({
                    position: "center",
                    width: 600,
                    padding: "3em",
                    icon: "error",
                    className: "swal-styling",
                    customClass: "swal-styling",
                    title: "File size is too large, must be under 10mb!",
                    showConfirmButton: false,
                    showCancelButton: false,
                    buttons: false,
                    timer: 5000
                    })   
                return;
            }

        // Checking if file already exists in songs folder, if it does, ask politely to rename song
        if (res.length !== 0) {
            http.open('HEAD', res, false);
            http.send();
            if (http.status === 200) {
                    swal({
                        position: "center",
                        width: 600,
                        padding: "3em",
                        icon: "error",
                        className: "swal-styling",
                        customClass: "swal-styling",
                        title: "Song name already exists, Please rename song so it does not overwrite other songs",
                        showConfirmButton: false,
                        showCancelButton: false,
                        buttons: false,
                        timer: 7000
                        })             
                exit;
            }
        // Checking file type is correct before appending new song to list
        if (newAddedSongType != 'wav' && newAddedSongType != 'mp3') {
            // console.log('no');
            swal({
                position: "center",
                width: 600,
                padding: "3em",
                icon: "error",
                className: "swal-styling",
                customClass: "swal-styling",
                title: "Sorry, that file type is not compatible, you can only use mp3 or wav files",
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
                timer: 6000
                })  
            exit; 

        } else {
           // console.log('yes');
           //After checking filetype is ok, change html to display only song name
            newAddedSong.innerHTML = newAddedSongAmended.substring(0, newAddedSongAmended.length - 4);                      
            songsContainer.append(newAddedSong);

            swal({
                position: "center",
                width: 600,
                padding: "3em",
                icon: "success",
                className: "swal-styling",
                customClass: "swal-styling",
                type: "success",
                title: "Song added Successfully. Select song from song dropdown to play it",
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
                timer: 7000
                })
        }
    }

        // If all clear above, then post song to folder list of songs on server
        $.ajax({
            type:'POST',
            url: $('#formupload').attr('action'),          
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(result){
        }
    })
})
           class DrumKit {
            constructor() {
                this.pads = document.querySelectorAll(".pad");
                this.playButton = document.querySelector(".plays");
                this.songAudio = document.querySelector(".song-sound");
                this.clapAudio = document.querySelector(".clap-sound"); //Selects the audio element for the instrument
                this.kickAudio = document.querySelector(".kick-sound");
                this.snareAudio = document.querySelector(".snare-sound");
                this.tomAudio = document.querySelector(".tom-sound");
                this.hihatAudio = document.querySelector(".hihat-sound");
                this.cowbellAudio = document.querySelector(".cowbell-sound");
                this.index = 0; //Track where we are in the sound loop
                this.bpm = 150;
                this.isPlaying = null;
                this.selections = document.querySelectorAll("select");
                this.muteButtons = document.querySelectorAll(".mute");
                this.tempoSlider = document.querySelector(".tempo-slider");
                this.tempoNumber = document.querySelector(".tempo-nr");
        
                this.currentKick = './sounds/ElectroDanger.wav';
                this.currentKick = './sounds/clap-808.wav';
                this.currentKick = './sounds/kick-808.wav';
                this.currentKick = './sounds/snare-808.wav';
                this.currentKick = './sounds/tom-808.wav';
                this.currentKick = './sounds/hihat-808.wav';
                this.currentKick = './sounds/cowbell-808.wav';
                this.trackSelect = document.querySelector('.available-tracks');
                this.saveButton = document.querySelector('.save-track');
                this.saveTrackButton = document.querySelector('.save-name');
                this.loadButton = document.querySelector('.load-track');
                this.deleteButton = document.querySelector('.delete-track');
                this.trackNameInput = document.querySelector('.track-name');
                this.activePadsNumber = 0;
                this.myTracks = localStorage.getItem('myTracks')
                    ? JSON.parse(localStorage.getItem('myTracks'))
                    : [];
                this.saveTrackInputs = document.querySelector('.save-track-inputs');
                this.loadTracks();
        
                this.trackSelect.selectedIndex = -1;
                
            }
            activePad(e) {
                e.target.classList.toggle('active');
                if (e.target.classList.contains('active')) {
                    this.activePadsNumber++;
                } else {
                    this.activePadsNumber--;
                }
            }
            repeat() {
                let step = this.index % 10;
                const activeBars = document.querySelectorAll(`.b${step}`);
                //Loop over pads
                activeBars.forEach((bar) => {
                    bar.style.animation = `playTrack 0.3s alternate ease-in-out 2`;
                    //Check if current pad is should be played
                    if (bar.classList.contains("active")) {
                        if (bar.classList.contains("song-pad")) {
                            // this.songAudio.currentTime = 0;
                            this.songAudio.play();
                        }
                        if (bar.classList.contains("clap-pad")) {
                            this.clapAudio.currentTime = 0;
                            this.clapAudio.play();
                            
                        }
                        if (bar.classList.contains("kick-pad")) {
                            this.kickAudio.currentTime = 0;
                            this.kickAudio.play();
                         
                        }
                        if (bar.classList.contains("snare-pad")) {
                            this.snareAudio.currentTime = 0;
                            this.snareAudio.play();
                        }
                        if (bar.classList.contains("tom-pad")) {
                            this.tomAudio.currentTime = 0;
                            this.tomAudio.play();
                        }
                        if (bar.classList.contains("hihat-pad")) {
                            this.hihatAudio.currentTime = 0;
                            this.hihatAudio.play();
                        }
                        if (bar.classList.contains("cowbell-pad")) {
                            this.cowbellAudio.currentTime = 0;
                            this.cowbellAudio.play();
                        }
                    }
                });
                this.index++;
            }
               
            start() {
                if (!this.isPlaying) {
                    this.isPlaying = setInterval(() => {
                        this.repeat();
                    }, (60 / this.bpm) * 1000);
                } else {
                    clearInterval(this.isPlaying);
                    this.isPlaying = null;                   
                }
            }
        
            updateButton() {
                if (this.isPlaying) {
                    this.playButton.innerHTML = "<i class='fas fa-pause'></i>";
                    this.playButton.classList.add('active');
                } else {
                    this.playButton.innerHTML = "<i class='fas fa-play'></i>";
                    this.playButton.classList.remove('active');
                    this.songAudio.pause();
                    this.songAudio.currentTime = 0;
                }
            }
        
            showSaveButton() {
                if (!this.saveButton.classList.contains('visible')) {
                    this.saveButton.classList.add('visible');
                } else {
                    if (this.activePadsNumber === 0) {
                        this.saveButton.classList.remove('visible');
                        this.saveTrackInputs.classList.add('hidden');
                    }
                }
            }
        
            loadTrackButton(e) {
                //Clear Sequence
                this.clearSequence();
        
                //Track Value is taken from option tag;
                // const trackValue = this.trackSelect.value;
        
                //Actually its better to use index, for performance
                //I assume that our tracks in select will be always indexed the same as objects
                //in the main track array
                const trackIndex = this.trackSelect.selectedIndex;
        
                //get the track
                const track = this.myTracks[trackIndex];
        
                //Output the track
                track.trackMix.forEach((mix) => {
                    this.pads.forEach((innerPad) => {
                        if (innerPad.classList.contains(mix[1])) {
                            if (innerPad.classList.contains(mix[2])) {
                                innerPad.classList.add('active');
                                return true;
                            }
                        }
                    });
                });
        
                document.querySelector('.tempo-nr').innerText = track.trackBPM;
                this.tempoSlider.value = track.trackBPM;
            }
        
            showLoadButtons(e) {
                if (
                    this.loadButton.classList.contains('hidden') &&
                    this.deleteButton.classList.contains('hidden')
                ) {
                    this.loadButton.classList.remove('hidden');
                    this.deleteButton.classList.remove('hidden');
                }
            }
        
            clearSequence() {
                this.pads.forEach((pad) => {
                    pad.classList.remove('active');
                });
            }
        
            showSaveTrackInputs() {
                this.saveTrackInputs.classList.remove('hidden');
            }
        
            saveCurrentMix(e) {
                const trackName = this.trackNameInput.value;
        
                if (trackName) {
                    const allPadsMix = Array.from(document.querySelectorAll('.pad'));
        
                    const currentPadsMix = allPadsMix.filter((el) =>
                        el.classList.contains('active')
                    );
        
                    //Make classes array
                    const currentPadsClassesArray = currentPadsMix.map(
                        (pad) => pad.classList
                    );
        
                    const trackValue = trackName.replace(/ /g, '_').toLowerCase();
        
                    const currentBPM = this.tempoSlider.value;
        
                    //Another approach
                    this.myTracks.push({
                        trackValue,
                        trackName,
                        trackMix: currentPadsClassesArray,
                        trackBPM: currentBPM,
                    });
                    localStorage.setItem('myTracks', JSON.stringify(this.myTracks));
        
                    //Rewrite main tracks array to remove extra value from Node List (weird things are there)
                    this.myTracks = JSON.parse(localStorage.getItem('myTracks'));
        
                    //Add name to the selects options;
                    const newOption = document.createElement('option');
                    newOption.text = trackName;
                    newOption.value = trackValue;
                    this.trackSelect.add(newOption);


                    

                    //TODO
                    // const audioOption = document.createElement('audio');
                    // audioOption.setAttribute('controls', true);
                    // audioOption.value = trackValue;
                    // this.trackSelect.add(audioOption);
                    // var trackAppendForDownload = document.getElementById('trackForDownload');
                    // trackAppendForDownload.append(audioOption);                   
                 
                } else {
                    alert('Imput Cannot be empty!');
                }
            }
        
            deleteCurrentMix(e) {
                //Getting track Value
                const trackValue = this.trackSelect.options[
                    this.trackSelect.selectedIndex
                ].value;
        
                //Changing local storage array
                const oldTracksArray = JSON.parse(localStorage.getItem('myTracks'));
                const newTracksArray = oldTracksArray.filter(
                    (el) => el.trackValue != trackValue
                );
        
                //Rewriting new array to local storage
                localStorage.setItem('myTracks', JSON.stringify(newTracksArray));
        
                //Rewriting inner array
                this.myTracks = newTracksArray;
        
                //UI changes
                this.trackSelect.remove(this.trackSelect.selectedIndex);
            }
        
            loadTracks() {
                const tracksSelect = Array.from(this.selections).filter(
                    (el) => el.className === 'available-tracks'
                );
        
                // Iterate through track data
                this.myTracks.forEach((track) => {
                    //Create option element and fill with data
                    const option = document.createElement('option');
                    option.innerText = track.trackName;
                    option.value = track.trackValue;
        
                    //Small hack because our select is array with one element
                    tracksSelect[0].add(option);
                    
                    // console.log(tracksSelect[0]);
                    console.log(track);
                });
            }
        
            changeSound(event) {
                const selectionName = event.target.name;
                const selectionValue = event.target.value;
                switch (selectionName) {
                    case "ssong-select":
                        this.songAudio.src = selectionValue;
                        break;
                    case "sclap-select":
                        this.clapAudio.src = selectionValue;
                        break;
                    case "skick-select":
                        this.kickAudio.src = selectionValue;
                        break;
                    case "ssnare-select":
                        this.snareAudio.src = selectionValue;
                        break;
                    case "stom-select":
                        this.tomAudio.src = selectionValue;
                        break;
                    case "shihat-select":
                        this.hihatAudio.src = selectionValue;
                        break;
                    case "scowbell-select":
                        this.tomAudio.src = selectionValue;
                        break;
                }
            }
            mute(e) {
                const muteTarget = e.target.getAttribute("data-track");
                console.log(muteTarget);
                e.target.classList.toggle("active");
                if (e.target.classList.contains("active")) {
                    switch (muteTarget) {
                        case "0":
                            this.songAudio.volume = 0;
                            break;
                        case "1":
                            this.clapAudio.volume = 0;
                            break;
                        case "2":
                            this.kickAudio.volume = 0;
                            break;
                        case "3":
                            this.snareAudio.volume = 0;
                            break;
                        case "4":
                            this.tomAudio.volume = 0;
                            break;
                        case "5":
                            this.hihatAudio.volume = 0;
                            break;
                        case "6":
                            this.cowbellAudio.volume = 0;
                            break;
                        
                    }
                } else {
                    switch (muteTarget) {
                        case "0":
                            this.songAudio.volume = 1;
                            break;
                        case "1":
                            this.clapAudio.volume = 1;
                            break;
                        case "2":
                            this.kickAudio.volume = 1;
                            break;
                        case "3":
                            this.snareAudio.volume = 1;
                            break;
                        case "4":
                            this.tomAudio.volume = 1;
                            break;
                        case "5":
                            this.hihatAudio.volume = 1;
                            break;
                        case "6":
                            this.cowbellAudio.volume = 1;
                            break;
                    }
                }
            }
            changeTempo(e) {
                this.tempoNumber.innerText = `${e.target.value}`;
                this.bpm = e.target.value;
            }
            updateTempo() {
                this.start();
                this.updateButton();
            }
        }
        
        const drumKit = new DrumKit();
        
        
        drumKit.pads.forEach((pad) => {
            pad.addEventListener('click', function (e) {
                drumKit.activePad(e);
            });
            pad.addEventListener('click', () => {
                drumKit.showSaveButton();
            });
            pad.addEventListener('animationend', function () {
                this.style.animation = '';
            });
        });
        
        drumKit.playButton.addEventListener("click", function () {
            drumKit.start();
            drumKit.updateButton();
        });
        
        drumKit.selections.forEach((select) => {
            if (select.className !== 'available-tracks') {
                select.addEventListener('change', function (e) {
                    drumKit.changeSound(e);
                });
            }
        });
        
        drumKit.muteButtons.forEach((btn) => {
            btn.addEventListener("click", function (e) {
                drumKit.mute(e);
            });
        });
        
        drumKit.tempoSlider.addEventListener("input", function (e) {
            drumKit.changeTempo(e);
        });
        
        drumKit.tempoSlider.addEventListener("change", function () {
            drumKit.updateTempo();
        });
        
        
        //Save Button
        drumKit.saveButton.addEventListener('click', function (e) {
            drumKit.showSaveTrackInputs();
        });
        
        //Load Button
        drumKit.loadButton.addEventListener('click', function (e) {
            drumKit.loadTrackButton(e);
        });
        drumKit.trackSelect.addEventListener('change', function (e) {
            drumKit.showLoadButtons(e);
        });
        
        //Save Track Name Button
        drumKit.saveTrackButton.addEventListener('click', function (e) {
            drumKit.saveCurrentMix(e);
        });
        
        //Delete Button
        drumKit.deleteButton.addEventListener('click', function (e) {
            drumKit.deleteCurrentMix(e);
        });
        
        
        // Volume Controls
        $(".volumet").slider({
            min: 0,
            max: 100,
            value: 50,
              range: "min",
            slide: function(event, ui) {
              setVolume(ui.value / 100);
            }
          });
        
          var myMedia = document.createElement('audio');
          $('.playert').append(myMedia);
          myMedia.id = "myMedia";
        
          function setVolume(myVolume) {
          var myMedia = document.querySelectorAll(".vol");
           for (i = 0; i < myMedia.length; i++) {
            myMedia[i].volume = myVolume;
            }
        }

   