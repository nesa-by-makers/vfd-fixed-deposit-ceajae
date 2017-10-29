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

    $fullname = $_POST['fullName'];
    $phonenumber = $_POST['phoneNumber'];
    $residentAddress = $_POST['residentAddress'];
    $occupation = $_POST['occupation'];
    $officeAddress = $_POST['officeAddress'];
    $duration = $_POST['proposedDuration'];
    $amount = $_POST['amount'];
    $accountNumber = $_POST['accountNumber'];
    $accountName = $_POST['accountName'];
    $bankName = $_POST['bankName'];
    $kinName = $_POST['kinName'];
    $kinNumber = $_POST['kinNumber'];
    $kinEmail = $_POST['kinEmail'];
    $reference = $_POST['reference'];



    $customerQuery = "INSERT INTO customer(FullName, PhoneNumber,Address,Occupation, OfficeAddress)
                       VALUES('".$fullname."','".$phonenumber."','".$residentAddress."','"
                            .$occupation."','".$officeAddress."')";

    if($connection->query($customerQuery) === true){
        $newCustomerID = $connection->insert_id;
        echo "new customer inserted successfully";

        echo "new customer id ".$newCustomerID;
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
