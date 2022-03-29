using Microsoft.Win32;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using System.Windows.Threading;

namespace Wpf_prg2_timers
{
    /// <summary>
    /// Interaction logic for Countdown.xaml
    /// </summary>
    /// 
    public partial class Countdown : Window
    {
        DispatcherTimer tmTimer = new DispatcherTimer();
        int iSeconds;


        public Countdown()
        {
            InitializeComponent();
            tmTimer.Interval = TimeSpan.FromSeconds(1);
            tmTimer.Tick += tmTimer_tick;
            tmTimer.Start();
        }

        private void tmTimer_tick(object sender, EventArgs e)
        {
            iSeconds = Convert.ToInt32(txtNumber.Text);
            iSeconds -= 1;

            txtNumber.Text = iSeconds.ToString();

            if(iSeconds == 0)
            {
                tmTimer.Stop();

                string sMessageText = "Geen naam";
                string sCaption = "OH NEE";

                MessageBoxButton msbButton = MessageBoxButton.OK;
                MessageBoxImage msbImage = MessageBoxImage.Question;
                MessageBoxResult msbResult = MessageBox.Show(sMessageText, sCaption, msbButton, msbImage);

                if (msbResult == MessageBoxResult.OK)
                {
                    txtNumber.Text = "10";
                    tmTimer.Start();
                }

            }

        }


        private void btnOK_Click(object sender, RoutedEventArgs e)
        {
            tmTimer.Stop();
            string sName = txtName.Text;

            WordRocket WR = new WordRocket(sName);

            WR.Show();

            this.Close();

        }
    }
}