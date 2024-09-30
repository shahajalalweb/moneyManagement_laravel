@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-xl">

  @if (isset($editBudget))

  <form action="{{route('budgetUpdate', $editBudget->id)}}" method="post" class="mb-6">
    @csrf 
    @method('PUT')
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label for="month" class="block text-sm font-medium text-gray-700">Edit Details</label>
        <input id="month" name="month" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$editBudget->month}}">
      </div>
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">Edit Budget</label>
        <input id="amount" type="number" name="budget" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{$editBudget->budget}}">
      </div>
    </div>
    <div class="mt-4 flex justify-center">
      <button type="submit" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-4 py-2 rounded-md hover:from-purple-800 hover:to-pink-600 rounded-lg">Edit</button>
    </div>
  </form>

  @else

  <form action="{{route('createBudget')}}" method="post" class="mb-6">
    @csrf 
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label for="month" class="block text-sm font-medium text-gray-700">Details Budget</label>
        <input id="month" name="month" type="text" placeholder="Enter budget details" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">Budget</label>
        <input id="amount" type="number" name="budget" placeholder="Enter budget amount" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>
    </div>
    <div class="mt-4 flex justify-center">
      <button type="submit" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-4 py-2 rounded-md hover:from-purple-800 hover:to-pink-600 rounded-lg">Submit</button>
    </div>
  </form>
  
  @endif
  

  <!-- Budget Table -->
  <div class="overflow-x-auto">
    <table class="w-full bg-white border border-gray-300">
      <thead>
        <tr class="bg-gray-50">
          <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Month</th>
          <th class="px-4 py-2 text-center text-sm font-medium text-gray-500">Budget Amount</th>
          <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- repeat for each budget entry -->
        @foreach ($budgetData as $value )
        <tr>
          <td class="px-4 py-2 border-t border-gray-300">{{$value->month}}</td>
          <td class="px-4 py-2 border-t border-gray-300 text-center">{{$value->budget}}</td>
          <td class="px-4 py-2 border-t border-gray-300 text-right">

            <a href="{{route('budgetEdit', $value->id)}}" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-3 py-1 rounded-xl text-sm hover:from-purple-800 hover:to-pink-600">Edit</a>

            <a href="{{route('budgetDel', $value->id)}}" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-3 py-1 rounded-xl text-sm hover:from-purple-800 hover:to-pink-600">Delete</a>
          </td>
        </tr>
          @endforeach
        <!-- Add more rows dynamically -->
      </tbody>
    </table>
  </div>
</div>


@endsection