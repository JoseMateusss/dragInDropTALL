<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @livewireStyles

  <script src="https://cdn.tailwindcss.com"></script>

  <style>

  </style>
</head>
<body class="bg-blue-500">
    <livewire:button-add-active/>
    <livewire:sales-orders-status-board 
    :sortable="true"
    :sortable-between-statuses="true"
    :record-click-enabled="true"
    />
    @livewireScripts
    <script src="js/app.js"></script>
  
</body>