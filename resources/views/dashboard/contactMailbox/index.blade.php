@extends('layouts.dashboard_master')

@section('content')

<div class="row">
    <div class="col">
        <div class="mailbox-container">

            <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="composeModalLabel">Compose Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label for="composeEmailTo" class="form-label">Email address</label>
                                <input type="email" class="form-control m-b-sm" id="composeEmailTo" aria-describedby="emailHelp">
                                <label for="composeTitle" class="form-label">Subject</label>
                                <input type="text" class="form-control m-b-lg" id="composeTitle" aria-describedby="title">
                                <div id="compose-editor"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-burger mailbox-compose-btn" data-bs-toggle="modal" data-bs-target="#composeModal"><i class="material-icons-outlined">create</i></button>
            <div class="card">
                <div class="container-fluid">
                    <div class="row">
                        <div class="mailbox-list col-xl-4">
                            <ul class="list-unstyled">
                                @forelse ($mailbox as $mail)

                                    <li class="mailbox-list-item" data-date="{{ $mail->created_at }}" data-email="{{ $mail->email }}" data-message="{{ $mail->message }}" data-id="{{ $mail->id }}">
                                        <a href="#">

                                            <img src="{{ asset('uploads/default/profile.png') }}" alt="">
                                            <div class="mailbox-list-item-content">
                                                <span class="mailbox-list-item-title">
                                                    {{ $mail->name }}
                                                </span>
                                                <p class="mailbox-list-item-text">
                                                    {{ $mail->subject }}
                                                </p>
                                            </div>
                                            <span class="badge badge-primary text-end">New</span>

                                        </a>
                                    </li>
                                @empty

                                @endforelse

                            </ul>
                        </div>
                        <div class="mailbox-open-content col-xl-8">
                            <span class="mailbox-open-date"></span>
                            <h5 class="mailbox-open-title">

                            </h5>
                            <div class="mailbox-open-author">
                                <img src="{{ asset('uploads/default/profile.png') }}" alt="">
                                <div class="mailbox-open-author-info">
                                    <span class="mailbox-open-author-info-email d-block">example@gmail.com</span>
                                    <span class="mailbox-open-author-info-to">From: <span class="badge badge-info align-self-center from-mail"></span></span>
                                </div>
                                <div class="mailbox-open-actions">
                                    <a href="{{ route('mail.delete', ['id' => $mail->id]) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            <div class="mailbox-open-content-email">
                                <p>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')

<script>
    $(document).ready(function () {
        // Handle click event on mailbox list items
        $('.mailbox-list-item').on('click', function () {
            // Remove the 'active' class from all list items
            $('.mailbox-list-item').removeClass('active');

            // Add 'active' class to the clicked list item
            $(this).addClass('active');

            // Get the data associated with the clicked item
            var name = $(this).find('.mailbox-list-item-title').text();
            var subject = $(this).find('.mailbox-list-item-text').text();

            // Update the content in the mailbox-open-content section
            var id = $(this).data('id');
            var date = $(this).data('date');
            var email = $(this).data('email');
            var message = $(this).data('message');

            //$('.mailbox-open-actions a').text(id);
            $('.mailbox-open-date').text(date);
            $('.mailbox-open-title').text(subject);
            $('.mailbox-open-author-info-email').text(name);
            $('.from-mail').text(email);
            $('.mailbox-open-content-email p').text(message);
        });
    });
</script>

@endsection

