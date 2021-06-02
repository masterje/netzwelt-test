<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <ul id="myUL">

            @foreach($data as $row)
            <li><span class="caret">{{$row['name']}}</span>
                <ul class="nested">
              @foreach($row['child'] as $child)
                <li>
                  <span class="caret"> - {{$child['name']}}</span>

                  @if(isset($child['child']))
                    <ul class="nested">
                    @foreach($child['child'] as $kid)
                        <li>
                          <span class="caret"> -- {{$kid['name']}}</span>

                            @if(isset($kid['child']))
                              <ul class="nested">
                                @foreach($kid['child'] as $kk)
                                <li> --- {{$kk['name']}}</li>
                                @endforeach
                              </ul>
                            @endif

                        </li>
                    @endforeach
                    </ul>
                  @endif

                </li>
              @endforeach
                </ul>
            </li>
            @endforeach

        </ul>
      </div>
    </div>

</x-app-layout>
