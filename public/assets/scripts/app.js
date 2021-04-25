
URL = window.URL || window.webkitURL;

var gumStream; 						//stream fdari getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode untuk merekam

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context untuk membantu perekaman

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");

var kalimat = [];
var srcAudio = document.getElementById('outputBotAudio');
srcAudio.src = 'audio/Pertanyaan/greeting.mp3';

var outputYou = document.getElementById('outputYou');
var outputBot = document.getElementById('outputBot');

outputBot.innerHTML = "Halo! Selamat datang di layanan voicebot kami. Ada yang bisa dibantu?";

var tanya = document.getElementById("tanya");
var buttonIya = document.getElementById("buttonIya");

buttonIya.style.display='none';

//menambahkan events ke button
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);

function startRecording() {
	console.log("recordButton clicked");
     buttonIya.style.display='none';
    var constraints = { audio: true, video:false }

 	/*
    	Nonaktifkan tombol rekam sampai mendapat hasil berhasil atau gagal dari getUserMedia ()
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	

	/*
    	menggunakan standar dari getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			membuat konteks audio setelah getUserMedia disebut 
			sampleRate mungkin berubah setelah getUserMedia dipanggil, 
			seperti yang terjadi pada macOS saat merekam melalui AirPods 
			sampleRate secara default yg terset adalah dari alat perekamnya
		*/
		audioContext = new AudioContext();

		//mengupdate format
		document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  menset gumStream untuk dipakai nanti  */
		gumStream = stream;
		
		/* menggunakan stream */
		input = audioContext.createMediaStreamSource(stream);

		/* 
			Buat objek Perekam dan konfigurasikan untuk merekam suara mono (1 saluran) 
			Merekam 2 saluran akan menggandakan ukuran file
		*/
		rec = new Recorder(input,{numChannels:1})

		//memulai proses perekaman
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//mengaktifkan tombol rekam jika getUserMedia() gagal
    	recordButton.disabled = false;
    	stopButton.disabled = true;
	});
}



function stopRecording() {
	console.log("stopButton clicked");

	//nonaktifkan tombol berhenti, mengaktifkan tombol rekam untuk memungkinkan rekaman baru
	stopButton.disabled = true;
	recordButton.disabled = false;
	
	//memanggil perekam untuk menghentikan rekaman
	rec.stop();

	//menghentikan akses mikrofon
	gumStream.getAudioTracks()[0].stop();

	//buat blob wav dan teruskan ke createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//nama file .wav yang akan digunakan selama mengunggah dan mengunduh
	var tzoffset = (new Date()).getTimezoneOffset() * 60000; 
	var filename = (new Date(Date.now() - tzoffset)).toISOString().slice(0, -1);


	fetch(url).then(response => response.blob())
	.then(blob => { 
	  const fd = new FormData();
	  fd.append("fileName", blob, "file.wav"); // where `.ext` matches file `MIME` type  
	  return fetch("/", {method:"POST", body:fd})
	})


	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//link untuk penyimpanan ke lokal
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = "Simpan";

	//menambahkan elemen audio yang baru ke li 
	li.appendChild(au);
	
	//menambahkan nama file ke li
	//li.appendChild(document.createTextNode(filename+".wav "))

	//menambahkan link untuk menyimpan audio ke li
	//li.appendChild(link);
	

	//upload link
	var upload = document.createElement('a');

	upload.href = "/upload"

	var audio_path = "/public/audio/Pertanyaan";

	// upload.innerHTML = "Upload";
	// upload.addEventListener("click", function(event){
	// 	  event.preventDefault();
		  var fd=new FormData();

		  fd.append("voice",blob, filename);
		 var sendAudio = $.ajax({
	        type: 'POST',
	        url: '/upload',
	        data: fd,
	        processData: false,
	        contentType: false,
	        beforeSend: function(){
	        		document.getElementById('outputYou').innerHTML = "Sedang diproses...";
	        		document.getElementById('outputBot').innerHTML = "Sedang diproses...";
	        },
	        success: function (result) {
	            console.log("sukses");  
	            
	            console.log(result); 
				
	            var len = result.length;
	            for(var i=0; i<len; i++){
	            	outputYou.innerHTML = (result[i].sentence).toUpperCase();
                    outputBot.innerHTML = (result[i].jawaban).toUpperCase();
	            	kalimat.push(result[i].sentence);
	            	kal = result[i].sentence;
	            	srcAudio.src = 'audio/Pertanyaan/'.concat(result[i].path);
	            			
	            			if (result[i].path == "penutup.wav") {
	                 			console.log("tutup");
		            			srcAudio.onended = function () {
						        	window.location.reload()
						       	}
	            			}
	            	buttonIya.style.display='block';
	        	}
	        },
	        error: function(request) { 
	            alert('error!!');
                console.log(request.responseText);
	        }

	    });

		
	// })
	li.appendChild(document.createTextNode (" "));//add a space in between
	li.appendChild(upload);//add the upload link to li

}

  $(function () {
            $('#formKalimat').submit(function (e) {
                e.preventDefault()  // prevent the form from 'submitting'

                var sendkalimat = $.ajax({
                    type:"post",
                    url: "/inputKalimat",
                    data:$(this).serialize(),
		           beforeSend: function(){
			        		document.getElementById('outputYou').innerHTML = "Sedang diproses...";
			        		document.getElementById('outputBot').innerHTML = "Sedang diproses...";
			        },
                    success:function(response){
                        console.log("berhasil");
                        $('#myModal').modal('hide');
                        buttonIya.style.display='none';
                        console.log(response);
                         var len = response.length;
	            		for(var i=0; i<len; i++){
                        	outputYou.innerHTML = (response[i].sentence).toUpperCase();
                        	outputBot.innerHTML = (response[i].jawaban);
                        	kal = response[i].sentence;
                        	srcAudio.src = 'audio/Pertanyaan/'.concat(response[i].path);
	            			
	            			if (response[i].path == "penutup.wav") {
	                 			console.log("tutup");
		            			srcAudio.onended = function () {
						        	window.location.reload()
						       	}
	            			}
	            		}
                      },
                      error:function(error){
                        console.log(error)
                        alert("not send");
                      }
                  });
            })
        })

