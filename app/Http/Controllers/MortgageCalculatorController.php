<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MortgageCalculatorController extends Controller
{
    public function showForm()
    {
        return view('frontend.mortgage_form');
    }

    public function calculateMortgage(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'loan_amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'loan_term' => 'required|integer|min:1', // Loan term in months
        ]);

        // Get the input values
        $loanAmount = $validated['loan_amount'];
        $interestRate = $validated['interest_rate'] / 100 / 12; // Monthly interest rate
        $loanTerm = $validated['loan_term']; // Loan term is already in months

        // Calculate the monthly payment using the formula
        $monthlyPayment = $loanAmount * $interestRate / (1 - pow(1 + $interestRate, -$loanTerm));

        // Calculate the total interest paid over the life of the loan
        $totalAmount = $monthlyPayment * $loanTerm;
        $totalInterest = $totalAmount - $loanAmount;

        // Format the values to 2 decimal places
        $monthlyPayment = number_format($monthlyPayment, 2);
        $totalInterest = number_format($totalInterest, 2);
        $totalAmount = number_format($totalAmount, 2);
        return view('frontend.mortgage_form', compact('monthlyPayment','totalInterest','totalAmount'));
    }
}
