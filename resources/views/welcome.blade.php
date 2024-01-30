<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div>
    {{auth()->user()}}
</div>
<div>
welcome
</div>
<div>
    Оплата сбер
</div>
@if(auth())
<form action="{{route('pay')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">amount</label>
        <input name="amount" type="number" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endif
</body>
</html>
