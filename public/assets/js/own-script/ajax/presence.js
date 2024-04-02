$('#date').flatpickr({
    dateFormat: 'd F Y H:i',
    enableTime: true,
    time_24hr: true
});

function getLocation()
{
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    Swal.fire("Error!", "Geolocation is not supported by this browser.", 'error');
  }
  // setTimeout(getLocation, 1000);
}

function showPosition(position) {
  var button = $('#buttonGetLocation');
  let lat = position.coords.latitude;
  let lng = position.coords.longitude;

  button.attr('disabled', true);
  $('#location').val('Please wait...');

  $.ajax({
    url: base_url + 'presence/getReverseLocation',
    method: 'GET',
    dataType: 'json',
    data: {latitude: lat, longitude: lng},
    success: (result) => {
      if(result.response == 200)
      {
        Swal.fire("Success!", "Your Location has been tracked.", "success");
        $('#location').val(result.place);
        // $('#coords').val(result.latlng);
      } else {
        Swal.fire('Failed!', "An error occured when tracking your location.", 'error');
      }
    },
    error: () => {
      Swal.fire('Error!', "Something went wrong! Please try again.", 'error');
      $('#location').val();
    },
    complete: () => {
      button.attr('disabled', false);
    }
  })
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
      toastr.error("User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
      toastr.error("Location information is unavailable.");
      break;
    case error.TIMEOUT:
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
      toastr.error("The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: true,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
      };
      toastr.error("An unknown error occurred.");
      break;
  }
}

$('#buttonSubmit').on('click', () => {
  let form = new FormData($('#FormPresence')[0]);
  let button = $('#buttonSubmit');

  button.html('Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span>').attr('disabled', true);

  $.ajax({
    url: base_url + "presence/store",
    type: "POST",
    data: form,
    processData: false,
    contentType: false,
    dataType: "json",
    async: true,
    success: () => {
      Swal.fire('Success!', 'Presence successfully submitted', 'success');
      window.setTimeout(() => {
        window.location.href = base_url + 'presence/history';
      }, 2000);
    },
    complete: () => {
      button
        .html('<span class="indicator-label">Submit</span>')
        .attr("disabled", false);
    },
    error: () => {},
  });
});

var pictureDropzone = new Dropzone("#dropzonePicture", {
  url: base_url + "presence/uploadFile", // Set the url for your upload script location
  paramName: "file", // The name that will be used to transfer the file
  maxFiles: 1,
  maxFilesize: 100, // MB
  addRemoveLinks: true,
  acceptedFiles: 'image/*',
  accept: function (file, done) {
    done();
  },
  success: (file, result) => {
    // var id = JSON.parse(result);
    // console.log(result);
    $('#pictureFileName').val(result.file);
    Swal.fire('Success!', result.message, 'success');
  },
  error: (file, result) => {
    pictureDropzone.removeFile(file);
    Swal.fire(
      'Error!', 'An error occured! Please try again.', 'error'
    );
  }
});

pictureDropzone.on('sending', (file, done, result) => {
  let user_id = $('#created_by').val();
  result.append('user_id', user_id);
});

pictureDropzone.on('removedfile', (e) => {
  let user_id = $('#created_by').val();
  let picture = $('#pictureFileName').val()
  $.ajax({
    url: base_url + 'presence/removeFile',
    type: 'POST',
    data: {user_id: user_id, pictureName: picture},
    cache: false,
    success: (result) => {
      let res = jQuery.parseJSON(result);
      if(res.response == 200)
      {
        Swal.fire('Success!', res.message, 'success');
      } else {
        Swal.fire('Error!', 'An error occured!', 'error');
      }
    },
    error: () => {
      Swal.fire('Error!', 'Something went wrong whet removing file.', 'error')
    }
  })
});





