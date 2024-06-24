@include('partials.header', ['title'=> 'Dashboard'])

<x-adminHeader></x-adminHeader>
<x-adminSidebar></x-adminSidebar>
<x-message></x-message>
{{-- @dd($total_count) --}}
<main class="w-[86.6%] absolute top-40 left-64 p-10">
    <section class="cards-content  flex flex-row items-center justify-between px-11 py-14">
        <div class="card-content text-center w-72 h-40 flex flex-col border-solid border-2 border-[#168753] rounded-md bg-[#fff] shadow-lg items-center justify-center">
            <div class="font-extrabold text-6xl">{{$total_student}}</div>
            <p class="text-2xl">Total students</p>
        </div>
        <div class="card-content text-center w-72 h-40 flex flex-col border-solid border-2 border-[#168753] rounded-md bg-[#fff] shadow-lg items-center justify-center">
            <div class="font-extrabold text-6xl">{{$totalNewStudent}}</div>
            <p class="text-2xl">New Students</p>
        </div>
        <div class="card-content text-center w-72 h-40 flex flex-col border-solid border-2 border-[#168753] rounded-md bg-[#fff] shadow-lg items-center justify-center">
            <div class="font-extrabold text-6xl">{{$total_pending}}</div>
            <p class="text-2xl">Total Number of Pending Student</p>
        </div>
    </section>

    <section class="chart-card-content">
        <div class="chart w-full h-[40vh]">
            <canvas id="myChart" height="3vh" width="13vw"></canvas>
        </div>
    </section>

</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    const d = new Date();
    let name = month[d.getMonth()];

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!!json_encode($labels)!!},
        datasets: [{
          label: `# of Accepted Students this ${name}`,
          data:{{json_encode($values)}},
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
@include('partials.footer')
