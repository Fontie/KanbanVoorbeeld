using System;
using System.Collections.Generic;
using System.IO;
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
    /// Interaction logic for WordRocket.xaml
    /// </summary>
    public partial class WordRocket : Window
    {
        //De timer die de linker margin van de raket aanpast
        DispatcherTimer tmTimer = new DispatcherTimer();
        //De lijst waarin de woorden komen te staan
        List<string> lstWords = new List<string>();
        //Een random waarmee we random woorden uit de lijst kunnen kiezen
        Random rnd = new Random();
        //de eindwaarde van de raket       
        double dEndPoint = 0;

        public WordRocket(string sNamePlayer)
        {
            InitializeComponent();
            lblName.Content = sNamePlayer;

            tmTimer.Interval = TimeSpan.FromMilliseconds(10);
            tmTimer.Tick += Timer_Tick;

            dEndPoint = this.Width - rEndGame.Width - lblWord.Width;

            //bewegen stopt bij breedte scherm - zwarte rectangle - lengte raket           
        }

        private void Timer_Tick(object sender, EventArgs e)
        {
            //verschuif de Margin van het label van de raket
            lblWord.Margin = new Thickness(lblWord.Margin.Left + 1, lblWord.Margin.Top, 0, 0);

            //stop met bewegen al de linkerkant van de raket het eindpunt raakt
            if(lblWord.Margin.Left >= dEndPoint)
            {
                tmTimer.Stop();
                
                if(MessageBox.Show("OH NEE\nHet schip is kapot!!!\nNog een keer proberen?","GAME OVER",MessageBoxButton.YesNo) == MessageBoxResult.Yes)
                {
                    SetInitialPosition();
                }
                else
                {
                    this.Close();
                }
            }
            
        }
        private void txtWordToCheck_TextChanged(object sender, TextChangedEventArgs e)
        {
            //Alleen controleren wanneer beide controls geinitialiseerd zijn
            if((lblWord != null) && (txtWordToCheck != null))
            {
                if (txtWordToCheck.Text.Length == 0)
                {
                    return;
                }
                else
                {
                    //Is het label gelijk aan het tekstvak en houdt geen rekening met hoofdletters     
                    if (txtWordToCheck.Text.ToUpper() == lblWord.Content.ToString().ToUpper())
                    {
                        int punten = Convert.ToInt32(lblNrCorrect.Content.ToString());
                        punten += 1;

                        lblNrCorrect.Content = punten.ToString();

                        NextWord();
                    }
                }
            }
                          
                    //punt erbij               
                    //het volgende woord                        
                   
            
        }
        private void btnStart_Click(object sender, RoutedEventArgs e)
        {
            btnStart.Visibility = Visibility.Hidden;
            tmTimer.Start();

            NewGame();
            NextWord();
        
        }

        private void NewGame()
        {
            lstWords.Clear();
            lstWords.AddRange(File.ReadAllLines("resources\\woorden.txt"));
        }

        private void NextWord()
        {
            if (lstWords.Count > 0)
            {
                txtWordToCheck.Text = string.Empty;
                lblWord.Content = lstWords[rnd.Next(0, lstWords.Count)];

                lstWords.Remove(lblWord.Content.ToString());
                lblWord.Margin = new Thickness(0, lblWord.Margin.Top, 0, 0);
            }
            else
            {
                tmTimer.Stop();

                if (MessageBox.Show("HOERA\nHet schip is veilig!!!\nNog een keer spelen?", "GEWONNEN", MessageBoxButton.YesNo) == MessageBoxResult.Yes)
                {
                    SetInitialPosition();
                }
                else
                {
                    this.Close();
                }
            }
        }

        private void SetInitialPosition()
        {
            btnStart.Visibility = Visibility.Visible;
            lblWord.Margin = new Thickness(0, lblWord.Margin.Top, 0, 0);
            lblWord.Content = string.Empty;
            txtWordToCheck.Text = string.Empty;
            lblNrCorrect.Content = "0";
        }
    }
}
