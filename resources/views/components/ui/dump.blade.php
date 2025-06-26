@props([
    'data' => 'null',
])

@role('root')
    <div style="background-color: #18171b"
        class="border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden mt-4">
        <div class="px-6 py-4 mt-4 mb-4 me-4 ms-4">
            @dump($data)
        </div>
    </div>
@endrole
