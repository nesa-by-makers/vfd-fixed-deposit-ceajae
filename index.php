<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'molchi1996';
    $database = 'vdform';

    $connection = new mysqli($server, $username, $password, $database);

    if($connection->connect_error){
       die('Database connection failed:' . $connection->connect_error);

    }

    echo 'We have connectes oh!';

    $fullname = mysqli_real_escape_string($connection,$_POST['fullName']);
    $phonenumber = mysqli_real_escape_string($connection,$_POST['phoneNumber']);
    $residentAddress = mysqli_real_escape_string($connection,$_POST['residentAddress']);
    $occupation = mysqli_real_escape_string($connection,$_POST['occupation']);
    $officeAddress = mysqli_real_escape_string($connection,$_POST['officeAddress']);
    $duration = mysqli_real_escape_string($connection,$_POST['proposedDuration']);
    $amount = mysqli_real_escape_string($connection,$_POST['amount']);
    $accountNumber = mysqli_real_escape_string($connection,$_POST['accountNumber']);
    $accountName = mysqli_real_escape_string($connection,$_POST['accountName']);
    $bankName = mysqli_real_escape_string($connection,$_POST['bankName']);
    $kinName = mysqli_real_escape_string($connection,$_POST['kinName']);
    $kinNumber = mysqli_real_escape_string($connection,$_POST['kinNumber']);
    $kinEmail = mysqli_real_escape_string($connection,$_POST['kinEmail']);
    $reference = mysqli_real_escape_string($connection,$_POST['reference']);



    $customerQuery = "INSERT INTO customer(FullName, PhoneNumber,Address,Occupation, OfficeAddress)
                       VALUES('".$fullname."','".$phonenumber."','".$residentAddress."','"
                            .$occupation."','".$officeAddress."')";

    if($connection->query($customerQuery) === true){
        $newCustomerID = $connection->insert_id;
        echo "new customer inserted successfully with ID ".$newCustomerID;
    }else{
        echo "Somehting bad happened-".$connection->error;
    }


    $payOutDetailsQuery = "INSERT INTO payoutdetails(AccountName, AccountNumber,BankName, CustomerID)
                            VALUES('".$accountName."','".$accountNumber."','".$bankName."','"
                                      .$newCustomerID."')";

    if($connection->query($payOutDetailsQuery) === true){
        echo "payout details inserted successfully";
        $newPayOutID = $connection->insert_id;
        echo $newPayOutID;
    }else{
        echo "Somehting bad happened-".$connection->error;
    }


    $placementInfoQuery = "INSERT INTO placementInfo(PayOutID, ProposedDuration,Amount)
                            VALUES('".$newPayOutID."','".$duration."','".$amount."')";

    $nextOfKinQuery= "INSERT INTO nextOfKin(NameOfKin, PhoneNumber,Email, CustomerID)
                        VALUES('".$kinName."','".$kinNumber."','".$kinEmail."','".$newCustomerID."')";






    if($connection->query($placementInfoQuery)==true && $connection->query($nextOfKinQuery)==true){
         echo "record details inserted successfully";
    }else{
        echo "Somehting bad happened-".$connection->error;
    }


    $connection->close();



?>
