<div style="font-family: Helvetica, Arial, sans-serif; min-width: 600px; overflow: auto; line-height: 1.6; color: #333;">
    <div style="max-width: 700px; margin: 40px auto; padding: 20px; background: #f8f9fa; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="border-bottom: 1px solid #ddd; padding-bottom: 10px; text-align: center;">
            <a href="#" style="font-size: 1.5em; color: #00466a; text-decoration: none; font-weight: bold;">Car Rental</a>
        </div>
        <p style="font-size: 1.2em; font-weight: bold;">{{ $salutation }},</p>
        <p style="font-size: 1.1em;">{{ $messages }}</p>

        <div style="background: #fff; padding: 15px; border-radius: 5px; margin: 15px 0; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
            <p style="margin: 5px 0;"><strong>Customer Name:</strong> {{ $user->name }}</p>
            <p style="margin: 5px 0;"><strong>Car Name:</strong> {{ $car->name }}</p>
            <p style="margin: 5px 0;"><strong>Brand:</strong> {{ $car->brand }}</p>
            <p style="margin: 5px 0;"><strong>Model:</strong> {{ $car->model }}</p>
            <p style="margin: 5px 0;"><strong>Type:</strong> {{ $car->car_type }}</p>
            <p style="margin: 5px 0;"><strong>Start Date:</strong> {{ $start_date }}</p>
            <p style="margin: 5px 0;"><strong>End Date:</strong> {{ $end_date }}</p>
            <p style="margin: 5px 0; font-size: 1.1em; font-weight: bold;"><strong>Total Cost:</strong> TK{{ $cost }}</p>
        </div>

        <p style="font-size: 1em;">Best regards,</p>
        <p style="font-weight: bold;">Car Rental Team</p>

        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;" />

        <div style="text-align: center; font-size: 0.9em; color: #777;">
            <p><strong>Md Mahfoozur Rahman</strong></p>
            <p>204 East Kafrul, Dhaka, Bangladesh</p>
        </div>
    </div>
</div>
