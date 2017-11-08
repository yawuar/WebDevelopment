<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Participants</title>
  </head>
  <body>
    
    <table>
      
      <tr>
        
          <tr>
            
              <th>Firstname</th>
              
              <th>Lastname</th>
              
              <th>Address</th>
              
              <th>Email</th>
              
              <th>Ip adress</th>
              
          </tr>
          
      </tr>
      
      @foreach($users as $user)
      
        <tr>
          
            <td>{{ $user['firstname'] }}</td>
            
            <td>{{ $user['lastname'] }}</td>
            
            <td>{{ $user['address'] . ' ' . $user['number'] . ', ' . $user['zipcode'] . ' ' . $user['city'] }}</td>
            
            <td>{{ $user['email'] }}</td>
            
            <td>{{ $user['ip_address'] }}</td>
            
        </tr>
        
      @endforeach
      
    </table>
    
  </body>
</html>
