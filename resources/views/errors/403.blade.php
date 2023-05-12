@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden. You do not have permission to access this page. Please check your credentials or contact the administrator.'))
