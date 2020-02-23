@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <v-card>
                <v-card-title>Users</v-card-title>
                    <v-card-text>
                        <user-table></user-table> 
                    </v-card-text> 
                </v-card>
            </div>
        </div>
    </div>

    
@endsection