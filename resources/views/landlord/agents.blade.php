@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">My Agents</h1>
        <div>
            <a href="{{ route('landlord.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Pending Agent Verification Requests -->
@if($pendingAgents->count() > 0)
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold mb-4">Pending Agent Verification Requests</h2>
        
        <div class="space-y-4">
            @foreach($pendingAgents as $agent)
                <div class="border rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                <span class="text-lg font-bold text-purple-600">{{ substr($agent->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="font-medium">{{ $agent->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $agent->email }}</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <form method="POST" action="{{ route('landlord.agent.verify', $agent) }}">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                                    Verify Agent
                                </button>
                            </form>
                            
                            <!-- We're not providing a reject button since the relationship would remain but just be unverified -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

<!-- All Agents -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">My Verified Agents</h2>
    
    @if($agents->where('pivot.verified', true)->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Agent
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Since
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($agents->where('pivot.verified', true) as $agent)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <span class="text-lg font-bold text-purple-600">{{ substr($agent->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $agent->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $agent->email }}</div>
                                @if($agent->phone_number)
                                    <div class="text-sm text-gray-500">{{ $agent->phone_number }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Verified
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $agent->pivot->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form method="POST" action="{{ route('landlord.agent.unverify', $agent) }}" 
                                      onsubmit="return confirm('Are you sure you want to revoke this agent\'s verification?');">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Revoke Verification
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-gray-50 p-8 rounded-lg text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <h2 class="text-xl font-medium text-gray-600 mb-2">No Verified Agents</h2>
            <p class="text-gray-500">
                You don't have any verified agents working with you yet.
                @if($pendingAgents->count() > 0)
                    Check your pending verification requests above.
                @else
                    Agents will appear here once they request to work with you and you verify them.
                @endif
            </p>
        </div>
    @endif
</div>

<!-- Info Box -->
<div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mt-6" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm">
                <strong>About Agents:</strong> Agents can help you manage properties and tenants. They can add tenants to your properties and leave reviews, which you'll need to approve. Verified agents will appear in this list.
            </p>
        </div>
    </div>
</div>
@endsection
