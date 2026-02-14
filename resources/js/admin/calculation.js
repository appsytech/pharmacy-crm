function calculateSalary() {
    const baseSalaryInput = document.getElementById("base_salary");
    const bonusesInput = document.getElementById("bonuses");
    const taxPercentageInput = document.getElementById("tax_percentage");
    const taxAmountInput = document.getElementById("tax_amount");
    const totalSalaryInput = document.getElementById("total_salary");
    const paidAmountInput = document.getElementById("paid_amount");
    const remaningAmountInput = document.getElementById("remaining_amount");
    const advanceAmountInput = document.getElementById("advances");

    const ajaxSelectStaff = document.querySelector(".ajax-select-staff");

    const columnNameForStaffSalary = ajaxSelectStaff.dataset.column;
    const value = ajaxSelectStaff.value;

    const previousRemaining =
        Number(
            localStorage.getItem(
                `${columnNameForStaffSalary}-${value}-previous_remaining_salary`,
            ),
        ) || 0;

    const baseSalary = parseFloat(baseSalaryInput.value) || 0;
    const bonuses = parseFloat(bonusesInput.value) || 0;
    const taxPercentage = parseFloat(taxPercentageInput.value) || 0;
    const paidAmount = parseFloat(paidAmountInput.value) || 0;
    const advanceAmount = parseFloat(advanceAmountInput.value) || 0;

    const taxableAmount = baseSalary + bonuses;
    const taxAmount = (taxableAmount * taxPercentage) / 100;
    const totalSalary = taxableAmount - taxAmount - advanceAmount;
    const remaningSalary = previousRemaining + totalSalary - paidAmount;

    taxAmountInput.value = taxAmount.toFixed(2);
    totalSalaryInput.value = totalSalary.toFixed(2);
    remaningAmountInput.value = remaningSalary.toFixed(2);
}

function calculateInvestment() {
    const investmentOneField = document.getElementById("investment-one");
    const investmentTwoField = document.getElementById("investment-two");

    const totalInvestmentInput = document.getElementById("total-investment");

    const investmentOne = parseFloat(investmentOneField.value) || 0;
    const investmentTwo = parseFloat(investmentTwoField.value) || 0;

    const totalInvestment = investmentOne + investmentTwo;

    totalInvestmentInput.value = totalInvestment.toFixed(2);
}

function calculateRemaining() {
    const totalField = document.getElementById("totalAmount");
    const paidField = document.getElementById("paidAmount");

    const remainingInput = document.getElementById("remainingAmount");

    const total = parseFloat(totalField.value) || 0;
    const paid = parseFloat(paidField.value) || 0;

    const remaining = total - paid;
    remainingInput.value = remaining.toFixed(2);
}

export { calculateSalary, calculateInvestment, calculateRemaining };
