@extends('layouts.admin')

@section('title')
    @parent Новости
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Ajax Test</h2>
                        <button data-id="2" class="send">Отправить запрос</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script>
        let buttons = document.querySelectorAll('.send');
        buttons.forEach((elem) => {
            elem.addEventListener('click', () => {
                let id = elem.getAttribute('data-id');
                (
                    async () => {
                        const response = await fetch('/admin/ajax', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        });
                        const answer = await response.json();
                        console.log(answer);
                    }
                )();
            })
        });

    </script>
@endpush
