<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加用户</title>
</head>
<body>
    <form action="{{url('user/store')}}" method="post">
        <table>
            <tr>
                {{csrf_field()}}
                <td>用户名</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>用户名</td>
                <td><input type="submit" name="提交"></td>
            </tr>
        </table>
    </form>
</body>
</html>