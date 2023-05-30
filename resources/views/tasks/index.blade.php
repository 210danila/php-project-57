@extends('layouts.app')

@section('content')

    <div class="grid col-span-full">
        <h1 class="mb-5">Статусы</h1>

        <div>
            <h3>Секция для фильтрации</h3>
        </div>

        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Дата создания</th>
                </tr>
            </thead>
            <tbody><tr class="border-b border-dashed text-left">
                    <td>1</td>
                    <td>новая</td>
                    <td>23.05.2023</td>
                    <td></td>
                </tr>
                <tr class="border-b border-dashed text-left">
                    <td>2</td>
                    <td>завершена</td>
                    <td>23.05.2023</td>
                    <td></td>
                </tr>
                <tr class="border-b border-dashed text-left">
                    <td>3</td>
                    <td>выполняется</td>
                    <td>23.05.2023</td>
                    <td></td>
                </tr>
                <tr class="border-b border-dashed text-left">
                    <td>4</td>
                    <td>в архиве</td>
                    <td>23.05.2023</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection