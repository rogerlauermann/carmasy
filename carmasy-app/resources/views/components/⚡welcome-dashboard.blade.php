<?php

use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required|min:3')]
    public string $name = '';
    
    #[Validate('required|email')]
    public string $email = '';
    
    public bool $isDarkMode = false;
    public int $counter = 0;
    public array $notifications = [];
    
    public function mount()
    {
        $this->notifications = [
            ['id' => 1, 'message' => 'Welcome to Carmasy!', 'type' => 'success'],
            ['id' => 2, 'message' => 'Laravel 12 + Livewire v4 + Tailwind v4', 'type' => 'info'],
        ];
    }
    
    public function increment()
    {
        $this->counter++;
        $this->addNotification("Counter increased to {$this->counter}", 'success');
    }
    
    public function decrement()
    {
        $this->counter--;
        $this->addNotification("Counter decreased to {$this->counter}", 'warning');
    }
    
    public function toggleDarkMode()
    {
        $this->isDarkMode = !$this->isDarkMode;
        $this->addNotification($this->isDarkMode ? 'Dark mode enabled' : 'Light mode enabled', 'info');
    }
    
    public function save()
    {
        $this->validate();
        $this->addNotification("User {$this->name} saved successfully!", 'success');
        $this->reset(['name', 'email']);
    }
    
    public function dismissNotification($notificationId)
    {
        $this->notifications = array_filter($this->notifications, fn($n) => $n['id'] !== $notificationId);
    }
    
    private function addNotification(string $message, string $type = 'info')
    {
        $this->notifications[] = [
            'id' => time() . rand(100, 999),
            'message' => $message,
            'type' => $type
        ];
    }
};
?>

<div class="{{ $isDarkMode ? 'dark' : '' }} min-h-screen transition-colors duration-300">
    <div class="bg-white dark:bg-gray-900 min-h-screen">
        <!-- Header -->
        <header class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-800 dark:to-purple-800 text-white p-6 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Carmasy Dashboard</h1>
                    <p class="text-blue-100 dark:text-blue-200 mt-1">Laravel 12 + Livewire v4 + Tailwind CSS v4</p>
                </div>
                <button 
                    wire:click="toggleDarkMode"
                    class="px-4 py-2 text-sm bg-white/10 hover:bg-white/20 rounded-lg transition-colors"
                >
                    @if($isDarkMode)
                        🌞 Light Mode
                    @else
                        🌙 Dark Mode
                    @endif
                </button>
            </div>
        </header>

        <div class="container mx-auto p-6 space-y-8">
            <!-- Notifications -->
            @if(count($notifications) > 0)
                <div class="space-y-3">
                    @foreach($notifications as $notification)
                        <div 
                            wire:click="dismissNotification({{ $notification['id'] }})"
                            class="p-4 rounded-lg border cursor-pointer transition-all hover:shadow-md
                                {{ $notification['type'] === 'success' ? 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-200' : '' }}
                                {{ $notification['type'] === 'info' ? 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-200' : '' }}
                                {{ $notification['type'] === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/20 dark:border-yellow-800 dark:text-yellow-200' : '' }}
                            "
                        >
                            {{ $notification['message'] }}
                            <span class="float-right text-xs opacity-60">Click to dismiss</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Main Content Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Counter Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Interactive Counter</h2>
                    <div class="text-center space-y-4">
                        <div class="text-5xl font-bold text-blue-600 dark:text-blue-400">
                            {{ $counter }}
                        </div>
                        <div class="flex justify-center gap-3">
                            <button 
                                wire:click="decrement"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors"
                            >
                                -1
                            </button>
                            <button 
                                wire:click="increment"
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors"
                            >
                                +1
                            </button>
                        </div>
                    </div>
                </div>

                <!-- User Form Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">User Registration</h2>
                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                            <input 
                                wire:model="name" 
                                type="text"
                                placeholder="Enter your name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            />
                            @error('name') 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input 
                                wire:model="email" 
                                type="email"
                                placeholder="Enter your email"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            />
                            @error('email') 
                                <span class="text-red-500 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                        <button 
                            type="submit"
                            class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors"
                        >
                            Save User
                        </button>
                    </form>
                </div>

                <!-- Stats Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Technology Stack</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Laravel</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded text-sm">v12.47.0</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Livewire</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded text-sm">v4.0.1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Tailwind CSS</span>
                            <span class="px-2 py-1 bg-cyan-100 text-cyan-800 dark:bg-cyan-900 dark:text-cyan-200 rounded text-sm">v4.1</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Vite</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded text-sm">v7.3.1</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Showcase -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Livewire v4 Features</h2>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Single-file components
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Blaze compiler (20x faster)
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Validation attributes
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Real-time updates
                        </li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border dark:border-gray-700 p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">Tailwind CSS v4 Features</h2>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            CSS-first configuration
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            5x faster builds
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Built-in dark mode
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-green-500">✓</span>
                            Custom property API
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-100 dark:bg-gray-800 text-center py-8 mt-12">
            <p class="text-gray-600 dark:text-gray-400">
                Built with ❤️ using modern Laravel stack • 
                <span class="font-semibold">Carmasy Dashboard Demo</span>
            </p>
        </footer>
    </div>
</div>