@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
@endsection
@section('content')
<div class="container">

    <!-- Main Content -->
    <section class="section mt-4 mb-4">
        <div class="section-body">
            <div class="section-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-12 col-md-10">
                        <div class="card">
                            <div class="card-header text-center bg-white">
                                <h4>Jadwal Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="fc-overflow">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
        
        var calendarEl = document.getElementById('calendar');
        
        window.onload = function () {
            $('.calendar').addClass('row col-lg-12');
            };

            $(document).on('click', '.fc-button', function(e) {
                $('.calendar').addClass('row col-lg-12');
            });

        var calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
          events: '/karyawan/jadwal/1',
          timeZone: 'UTC+7',
          locale: 'id',
          lang: 'id',
          eventColor: '#378006',
          
          
        });
        calendar.render();
       
      });
</script>