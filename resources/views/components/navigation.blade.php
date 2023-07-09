<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a href="{{ route('root') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">@lang('Менеджер задач')</span>
        </a>

        <div class="flex items-center lg:order-2">
            @guest
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    @lang('Вход')
                </a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    @lang('Регистрация')
                </a>
            @else
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                    @lang('Выход')
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>

        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Задачи')
                    </a>
                </li>
                <li>
                    <a href="{{ route('task_statuses.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Статусы')
                    </a>
                </li>
                <li>
                    <a href="{{ route('labels.index') }}" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                        @lang('Метки')
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>