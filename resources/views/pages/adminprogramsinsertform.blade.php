@include('partials.header', ['title'=> 'TESDA QUALIFICATIONS ADD'])

<x-adminHeader></x-adminHeader>
<x-adminSidebar></x-adminSidebar>
<main class="w-[86.6%] absolute top-40 left-64 p-10">
    <div>
        <form action="{{route('addTesdaQualification')}}" method="post" class="flex flex-col gap-y-6" enctype="multipart/form-data">
            @csrf
            <div class="flex">
                <div class="inline-block w-1/2">
                    <label for="course_name" class="text-2xl">Course Name:</label>
                    <input type="text" name="course_name" id="course_name" class="h-10 bg-transparent border-green-500 border-b-4 ml-3">
                </div>
                <div class="inline-block w-1/2">
                    <label for="hours" class="text-2xl">Hours:</label>
                    <input type="number" name="hours" id="hours" class="h-10 bg-transparent border-green-500 border-b-4 ml-3">
                </div>
            </div>
            <div class="inline-block w-1/2">
                <label for="course_caption" class="text-2xl align-top">Course Captions:</label>
                <textarea name="course_caption" id="course_caption" cols="80" rows="10" class="h-[150px]"></textarea>
            </div>

            <div class="text-2xl">
                Qualification:
            </div>
            <div class="grid grid-cols-4 gap-x-1">
                 <input type="text" name="qualification[]" id="qualification-0" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>
                <div class="flex flex-col gap-y-1">
                    <div class="bg-blue-500 w-10 text-center rounded-lg cursor-pointer" id="qualification-add"><i class="fa-solid fa-plus"></i></div>
                    <div class="bg-red-500 w-10 text-center rounded-lg cursor-pointer" id="qualification-cancel"><i class="fa-solid fa-x"></i></div>
                </div>
            </div>

            <div class="text-2xl">
                Benefits:
            </div>
            <div class="grid grid-cols-4 gap-x-1">
                 <input type="text" name="benefits[]" id="benefits-0" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>
                <div class="flex flex-col gap-y-1">
                    <div class="bg-blue-500 w-10 text-center rounded-lg cursor-pointer" id="benefits-add"><i class="fa-solid fa-plus"></i></div>
                    <div class="bg-red-500 w-10 text-center rounded-lg cursor-pointer" id="benefits-cancel"><i class="fa-solid fa-x"></i></div>
                </div>
            </div>

            <div class="text-2xl">
                Core Competencies:
            </div>
            <div class="grid grid-cols-4 gap-x-1">
                 <input type="text" name="competencies[]" id="competencies-0" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>
                <div class="flex flex-col gap-y-1">
                    <div class="bg-blue-500 w-10 text-center rounded-lg cursor-pointer" id="competencies-add"><i class="fa-solid fa-plus"></i></div>
                    <div class="bg-red-500 w-10 text-center rounded-lg cursor-pointer" id="competencies-cancel"><i class="fa-solid fa-x"></i></div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="flex gap-x-3">
                    <p>Attach file here:</p>
                    <div class="bg-slate-300 w-[20%] flex items-center justify-center h-[20vh] rounded-md cursor-pointer" >
                        <img src="/images/attach-file.png" alt="attach-file" id="img-file" class="w-full h-full">
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500">Invalid Image</p>
                @enderror
            </div>


            <input type="file" name="image" id="image" class="hidden">
            <div class="mx-auto">
                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">Submit</button>
            </div>

        </form>
    </div>
</main>
<script>
$(document).ready(()=>{
    let qualification_input = 0;
    let benefits_input = 0;
    let competencies_input = 0;
    $('#qualification-add').on('click',()=>{
        $(`#qualification-${qualification_input}`).eq(0).after(`<input type="text" name="qualification[]" id="qualification-${qualification_input+1}" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>`);
        qualification_input++;
    });
    $("#qualification-cancel").on('click', ()=>{
        if(qualification_input!==0){
            $(`#qualification-${qualification_input}`).remove();
        qualification_input--;
        }
    });

    $('#benefits-add').on('click',()=>{
        $(`#benefits-${benefits_input}`).eq(0).after(`<input type="text" name="benefits[]" id="benefits-${benefits_input+1}" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>`);
        benefits_input++;
    });
    $("#benefits-cancel").on('click', ()=>{
        if(benefits_input!==0){
            $(`#benefits-${benefits_input}`).remove();
            benefits_input--;
        }
    });

    $('#competencies-add').on('click',()=>{
        $(`#competencies-${competencies_input}`).eq(0).after(`<input type="text" name="competencies[]" id="competencies-${competencies_input+1}" class="h-10 bg-transparent border-green-500 border-b-4 mr-3" required>`);
        competencies_input++;
    });
    $("#competencies-cancel").on('click', ()=>{
        if(competencies_input!==0){
            $(`#competencies-${competencies_input}`).remove();
            competencies_input--;
        }
    });

    $("#img-file").on('click',()=>{
        $("#image").click();
    });

    const photoInp = $("#image");
        photoInp.change(function (e) {
            if(document.getElementById("image").files.length !== 0 ){
                file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $("#img-file")
                            .attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

})
</script>
@include('partials.footer')
