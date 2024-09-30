        @extends('layout')

        @section('content')
        <!-- dashboard section  -->
        <div class="flex flex-col">

          @foreach ($reports as $report)

          <div>
            <h4 class="ml-1 p-1 font-bold" style="color:purple;"> {{$report['title']}}</h4>
            <div class="flex flex-wrap -mx-3">
              <!-- card1 -->
               @foreach ($report['datas'] as $data)
               
               <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                 <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                   <div class="flex-auto p-4">
                     <div class="flex flex-row -mx-3">
                       <div class="flex-none w-2/3 max-w-full px-3">
                         <div>
                           <p class="mb-0 font-sans text-sm font-semibold leading-normal">{{$data['title']}}</p>
                           <h5 class="mb-0 font-bold">
                             {{$data['value']}}<span>BDT</span>
                           </h5>
                         </div>
                       </div>
                       <div class="px-3 text-right basis-1/3">
                         <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                         {!! $data['icons'] !!}
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>

               @endforeach


            </div>
          </div>
          
          @endforeach


        </div>

        @endsection